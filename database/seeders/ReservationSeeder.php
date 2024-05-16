<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        Reservation::create([
            'user_id' => 4,
            'facility_id' => 1,
            'event' => 'Acara 1',
            'reservation_start' => now(),
            'reservation_end' => now()->addHours(8),
            'status' => 'pending',
            'description' => 'Description of Example Reservation',
        ]);
        Reservation::create([
            'user_id' => 5,
            'facility_id' => 4,
            'event' => 'Acara 2',
            'reservation_start' => now(),
            'reservation_end' => now()->addHours(8),
            'status' => 'pending',
            'description' => 'Description of Example Reservation'
        ]);
    }
}