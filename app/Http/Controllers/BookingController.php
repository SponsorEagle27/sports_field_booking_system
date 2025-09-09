<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SportsField;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\PricingSetting;

class BookingController extends Controller
{
    public function search()
    {
        return view('booking.search');
    }

    public function searchFields(Request $request)
    {
        $query = SportsField::query();

        // Filter by sport type
        if ($request->filled('sport')) {
            $query->where('sport_type', $request->sport);
        }

        // Filter by size
        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }

        // Filter by surface
        if ($request->filled('surface') && $request->surface !== 'all') {
            $query->where('surface', $request->surface);
        }

        // Only show active fields (admin will set status to 'active')
        $query->where('status', 'active');

        // Get all fields and remove duplicates based on unique combination
        $fields = $query->get()->unique(function ($item) {
            return $item->name . '-' . $item->sport_type . '-' . $item->location . '-' . $item->size . '-' . $item->surface;
        })->values();

        // Attach is_favorited for current user without extra requests
        $userId = Auth::id();
        if ($userId) {
            $favoritedIds = \DB::table('favorites')
                ->where('user_id', $userId)
                ->pluck('sports_field_id')
                ->toArray();

            $fields = $fields->map(function ($field) use ($favoritedIds) {
                $field->is_favorited = in_array($field->id, $favoritedIds);
                return $field;
            });
        } else {
            $fields = $fields->map(function ($field) {
                $field->is_favorited = false;
                return $field;
            });
        }

        return response()->json([
            'success' => true,
            'fields' => $fields
        ]);
    }

    public function showField($id)
    {
        $field = SportsField::findOrFail($id);
        return view('booking.field-details', compact('field'));
    }

    public function checkAvailability(Request $request, $fieldId)
    {
        $field = SportsField::findOrFail($fieldId);
        $date = $request->input('date');
        
        if (!$date) {
            return response()->json(['error' => 'Date is required'], 400);
        }
        
        // Generate all possible time slots
        $allSlots = $field->generateTimeSlots();
        
        // Get existing bookings for this field and date
        $existingBookings = Booking::where('sports_field_id', $fieldId)
            ->where('booking_date', $date)
            ->where('status', '!=', 'cancelled')
            ->get();
        
        // Mark slots as booked if they have existing bookings and attach dynamic pricing
        foreach ($allSlots as &$slot) {
            $slotStart = $slot['start_time'];
            $slotEnd = $slot['end_time'];
            
            $isBooked = $existingBookings->contains(function ($booking) use ($slotStart, $slotEnd) {
                $bookingStart = \Carbon\Carbon::parse($booking->start_time)->format('H:i');
                $bookingEnd = \Carbon\Carbon::parse($booking->end_time)->format('H:i');
                
                return $bookingStart === $slotStart && $bookingEnd === $slotEnd;
            });
            
            $slot['available'] = !$isBooked;

            // Dynamic pricing based on admin settings (defaults 18:00 and +2000 if not set)
            $settings = PricingSetting::first();
            $peakStart = $settings ? \Carbon\Carbon::parse($settings->peak_start_time) : \Carbon\Carbon::createFromTime(18, 0);
            $surcharge = $settings ? (int) $settings->peak_surcharge : 2000;

            $isPeak = \Carbon\Carbon::createFromFormat('H:i', $slotStart)->greaterThanOrEqualTo($peakStart);
            $slot['peak'] = $isPeak;
            $slot['price'] = (int) $field->price_per_90min + ($isPeak ? $surcharge : 0);
        }
        
        return response()->json([
            'success' => true,
            'slots' => $allSlots
        ]);
    }

    public function myBookings(Request $request)
    {
        $query = Auth::user()->bookings()->with('sportsField');
        
        // Apply filters
        if ($request->filled('sport')) {
            $query->whereHas('sportsField', function($q) use ($request) {
                $q->where('sport_type', $request->sport);
            });
        }
        
        if ($request->filled('field')) {
            $query->whereHas('sportsField', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->field . '%');
            });
        }
        
        if ($request->filled('date_from')) {
            $query->where('booking_date', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->where('booking_date', '<=', $request->date_to);
        }
        
        $bookings = $query->orderBy('booking_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->paginate(10)->withQueryString();
        
        // Get unread notifications count
        $unreadNotifications = \App\Models\Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();
        
        // Get sports for filter dropdown
        $sports = \App\Models\SportsField::distinct()->pluck('sport_type')->sort();
            
        return view('booking.my-bookings', compact('bookings', 'unreadNotifications', 'sports'));
    }

    public function book(Request $request, $fieldId)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'price' => 'required|integer|min:0',
            'payment_method' => 'required|in:cash,bkash',
            'bkash_txn' => 'nullable|string|size:10',
            'bkash_ref' => 'nullable|string',
        ]);

        $field = SportsField::findOrFail($fieldId);

        // Prevent double booking: ensure no existing booking on this slot
        $alreadyBooked = Booking::where('sports_field_id', $fieldId)
            ->where('booking_date', $request->date)
            ->where('status', '!=', 'cancelled')
            ->whereTime('start_time', $request->start_time)
            ->whereTime('end_time', $request->end_time)
            ->exists();

        if ($alreadyBooked) {
            return response()->json(['success' => false, 'message' => 'This time slot has just been booked. Please choose another.'], 409);
        }

        $paymentStatus = $request->payment_method === 'bkash' ? 'paid' : 'pending';

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'sports_field_id' => $field->id,
            'booking_date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_price' => (int) $request->price,
            'status' => 'confirmed',
            'payment_method' => $request->payment_method,
            'payment_status' => $paymentStatus,
            'bkash_txn' => $request->payment_method === 'bkash' ? $request->bkash_txn : null,
            'bkash_ref' => $request->payment_method === 'bkash' ? $request->bkash_ref : null,
        ]);

        // Create notification for booking
        \App\Models\Notification::create([
            'user_id' => Auth::id(),
            'type' => 'booking_created',
            'title' => 'Booking Confirmed',
            'message' => "Your booking for {$field->name} on " . \Carbon\Carbon::parse($request->date)->format('M d, Y') . " has been confirmed.",
            'data' => ['booking_id' => $booking->id, 'field_id' => $field->id]
        ]);

        return response()->json(['success' => true, 'booking_id' => $booking->id]);
    }

    public function cancel(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Allow cancellation only within 60 seconds of creation
        if (now()->diffInSeconds($booking->created_at) > 60) {
            return response()->json(['success' => false, 'message' => 'Cancellation window has expired.'], 422);
        }

        $field = $booking->sportsField;
        $booking->delete();

        // Create notification for cancellation
        \App\Models\Notification::create([
            'user_id' => Auth::id(),
            'type' => 'booking_cancelled',
            'title' => 'Booking Cancelled',
            'message' => "Your booking for {$field->name} on " . \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') . " has been cancelled.",
            'data' => ['field_id' => $field->id]
        ]);

        return response()->json(['success' => true]);
    }
}