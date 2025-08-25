<?php

namespace Database\Seeders;

use App\Models\SportsField;
use Illuminate\Database\Seeder;

class SportsFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = [
            [
                'name' => 'Football Field 1',
                'description' => 'Professional size football field with natural grass',
                'type' => 'football',
                'location' => 'Central Sports Complex',
                'price_per_90min' => 50.00,
                'status' => 'available',
                'amenities' => ['lights', 'parking', 'changing_rooms', 'water_fountain'],
                'opening_time' => '6:00 AM',
                'closing_time' => '10:00 PM',
            ],
            [
                'name' => 'Basketball Court',
                'description' => 'Indoor basketball court with wooden flooring',
                'type' => 'basketball',
                'location' => 'Indoor Sports Center',
                'price_per_90min' => 30.00,
                'status' => 'available',
                'amenities' => ['lights', 'parking', 'changing_rooms', 'air_conditioning'],
                'opening_time' => '7:00 AM',
                'closing_time' => '11:00 PM',
            ],
            [
                'name' => 'Tennis Court 1',
                'description' => 'Professional tennis court with synthetic surface',
                'type' => 'tennis',
                'location' => 'Tennis Club',
                'price_per_90min' => 40.00,
                'status' => 'available',
                'amenities' => ['lights', 'parking', 'changing_rooms', 'equipment_rental'],
                'opening_time' => '6:00 AM',
                'closing_time' => '9:00 PM',
            ],
            [
                'name' => 'Cricket Ground',
                'description' => 'Large cricket ground with practice nets',
                'type' => 'cricket',
                'location' => 'Sports Academy',
                'price_per_90min' => 60.00,
                'status' => 'available',
                'amenities' => ['lights', 'parking', 'changing_rooms', 'practice_nets'],
                'opening_time' => '6:00 AM',
                'closing_time' => '8:00 PM',
            ],

        ];

        foreach ($fields as $field) {
            SportsField::create($field);
        }
    }
}
