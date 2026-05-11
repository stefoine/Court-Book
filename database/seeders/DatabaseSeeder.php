<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Booking;
use App\Models\Court;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::create([
            'name'     => 'System Admin',
            'email'    => 'admin@court.test',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'phone'    => '09171234567',
        ]);

        // Sample users
        $u1 = User::create([
            'name'  => 'Juan Dela Cruz', 'email' => 'user@court.test',
            'password' => Hash::make('password'), 'role' => 'user',
        ]);
        $u2 = User::create([
            'name'  => 'Maria Santos', 'email' => 'maria@court.test',
            'password' => Hash::make('password'), 'role' => 'user',
        ]);

        // Courts
        $courts = [
            ['name' => 'Main Basketball Court', 'type' => 'Basketball', 'capacity' => 30, 'hourly_rate' => 350,
             'description' => 'Full-size hardwood basketball court with lighting.'],
            ['name' => 'Volleyball Court A',    'type' => 'Volleyball', 'capacity' => 20, 'hourly_rate' => 250,
             'description' => 'Indoor volleyball court with regulation net.'],
            ['name' => 'Badminton Court 1',     'type' => 'Badminton',  'capacity' => 8,  'hourly_rate' => 180,
             'description' => 'Wooden flooring with proper line markings.'],
            ['name' => 'Futsal Field',          'type' => 'Futsal',     'capacity' => 16, 'hourly_rate' => 400,
             'description' => 'Synthetic turf futsal field with goals.'],
            ['name' => 'Multi-Purpose Hall',    'type' => 'Multi-Use',  'capacity' => 100,'hourly_rate' => 600,
             'description' => 'Large hall ideal for school and community events.'],
        ];
        foreach ($courts as $c) Court::create($c + ['is_available' => true]);

        // Sample bookings
        Booking::create([
            'user_id' => $u1->id, 'court_id' => 1,
            'sport_type' => 'Basketball', 'purpose' => 'Friendly match',
            'booking_date' => now()->addDays(2)->toDateString(),
            'start_time' => '18:00', 'end_time' => '20:00',
            'status' => 'pending', 'total_price' => 700,
        ]);
        Booking::create([
            'user_id' => $u2->id, 'court_id' => 3,
            'sport_type' => 'Badminton', 'purpose' => 'Training',
            'booking_date' => now()->addDays(1)->toDateString(),
            'start_time' => '07:00', 'end_time' => '09:00',
            'status' => 'approved', 'total_price' => 360,
        ]);

        // Announcement
        Announcement::create([
            'user_id' => $admin->id,
            'title'   => 'Welcome to the Multi-Purpose Court Booking System',
            'body'    => 'You can now reserve courts online. Please ensure payment proof is uploaded for paid sessions.',
            'is_published' => true,
        ]);
    }
}
