<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\SportsField;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get user's booking statistics
        $activeBookings = Booking::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->where('booking_date', '>=', now()->toDateString())
            ->count();
            
        $totalBookings = Booking::where('user_id', $user->id)->count();
        
        // Get user's favorite fields count
        $favoriteFields = Favorite::where('user_id', $user->id)->count();
        
        // Get recent bookings (last 5)
        $recentBookings = Booking::where('user_id', $user->id)
            ->with('sportsField')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('dashboard', compact(
            'activeBookings',
            'totalBookings', 
            'favoriteFields',
            'recentBookings'
        ));
    }
} 