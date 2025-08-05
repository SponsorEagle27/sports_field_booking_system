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
                'price_per_hour' => 50.00,
                'status' => 'available',
                'amenities' => ['lights', 'parking', 'changing_rooms', 'water_fountain'],
                'opening_time' => '06:00:00',
                'closing_time' => '22:00:00',
            ],
            [
                'name' => 'Basketball Court',
                'description' => 'Indoor basketball court with wooden flooring',
                'type' => 'basketball',
                'location' => 'Indoor Sports Center',
                'price_per_hour' => 30.00,
                'status' => 'available',
                'amenities' => ['lights', 'parking', 'changing_rooms', 'air_conditioning'],
                'opening_time' => '07:00:00',
                'closing_time' => '23:00:00',
            ],
            [
                'name' => 'Tennis Court 1',
                'description' => 'Professional tennis court with synthetic surface',
                'type' => 'tennis',
                'location' => 'Tennis Club',
                'price_per_hour' => 40.00,
                'status' => 'available',
                'amenities' => ['lights', 'parking', 'changing_rooms', 'equipment_rental'],
                'opening_time' => '06:00:00',
                'closing_time' => '21:00:00',
            ],
            [
                'name' => 'Cricket Ground',
                'description' => 'Large cricket ground with practice nets',
                'type' => 'cricket',
                'location' => 'Sports Academy',
                'price_per_hour' => 60.00,
                'status' => 'available',
                'amenities' => ['lights', 'parking', 'changing_rooms', 'practice_nets'],
                'opening_time' => '06:00:00',
                'closing_time' => '20:00:00',
            ],

        ];

        foreach ($fields as $field) {
            SportsField::create($field);
        }
    }
}
