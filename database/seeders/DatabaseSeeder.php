<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            SatkerMasterSeeder::class,
            FacilityCategorySeeder::class,
            UkerMasterSeeder::class,
            RoleMasterSeeder::class,
            UserSeeder::class,
            FacilitySeeder::class,
            ReservationSeeder::class,
        ]);
    }
}