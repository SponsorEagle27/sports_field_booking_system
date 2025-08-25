<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SportsField;

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

        // Only show active fields
        $query->where('status', 'active');

        // Get all fields and remove duplicates based on unique combination
        $fields = $query->get()->unique(function ($item) {
            return $item->name . '-' . $item->sport_type . '-' . $item->location . '-' . $item->size . '-' . $item->surface;
        })->values();

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
}
