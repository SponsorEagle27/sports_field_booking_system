<?php

namespace Database\Seeders;

use App\Models\SportsField;
use Illuminate\Database\Seeder;

class DhakaSportsFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Helper function to standardize 12-hour format
        $standardize12Hour = function($time12Hour) {
            // Handle formats like "6:00 AM", "6:00AM", "6:00 am", "6:00am", "6 AM", "6AM"
            $time = trim($time12Hour);
            
            // Extract time and AM/PM
            if (preg_match('/(\d{1,2}):?(\d{2})?\s*(AM|PM|am|pm)/', $time, $matches)) {
                $hour = (int)$matches[1];
                $minute = isset($matches[2]) ? (int)$matches[2] : 0;
                $period = strtoupper($matches[3]);
                
                // Return in standardized 12-hour format: "HH:MM AM/PM"
                return sprintf('%d:%02d %s', $hour, $minute, $period);
            }
            
            // If already in good format, return as is
            if (preg_match('/^\d{1,2}:\d{2}\s*(AM|PM|am|pm)$/', $time)) {
                return $time;
            }
            
            return $time; // Return original if can't parse
        };

        // Sample Dhaka sports fields data
        // You can replace this with your actual Excel data
        $dhakaFields = [
            [
                'name' => 'Dhaka Sporting Club Football Ground',
                'sport_type' => 'football',
                'location' => 'Gulshan-2',
                'address' => 'Road 25, Gulshan-2, Dhaka 1212',
                'size' => '11-a-side',
                'surface' => 'Grass',
                'price_per_90min' => 5000,
                'opening_time' => $standardize12Hour('6:00 AM'),
                'closing_time' => $standardize12Hour('10:00 PM'),
                'amenities' => ['lights', 'parking', 'changing_rooms', 'water_fountain'],
                'description' => 'Professional size football field with natural grass, floodlights, and parking facilities',
                'status' => 'available',
            ],
            [
                'name' => 'Banani Club Basketball Court',
                'sport_type' => 'basketball',
                'location' => 'Banani',
                'address' => 'Road 11, Banani, Dhaka 1213',
                'size' => 'Full Size',
                'surface' => 'Outdoor Court',
                'price_per_90min' => 3000,
                'opening_time' => $standardize12Hour('7:00 AM'),
                'closing_time' => $standardize12Hour('11:00 PM'),
                'amenities' => ['lights', 'parking', 'changing_rooms'],
                'description' => 'Professional basketball court with floodlights and parking',
                'status' => 'available',
            ],
            // Add more fields here with your Excel data
        ];

        foreach ($dhakaFields as $field) {
            SportsField::create($field);
        }
    }
}
