<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Superadmin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('1234567890'),
            'role_master_id' => 1,
            'uker_master_id' => 59, // Assuming there is an existing UkerMaster with id 1
            'has_facility' => false,
            'has_reservation' => false,
            'email_verified_at' => now()
        ]);
        User::create([
            'name' => 'Facility Manager',
            'email' => 'manager@manager.com',
            'password' => bcrypt('1234567890'),
            'role_master_id' => 2,
            'uker_master_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'has_facility' => false,
            'has_reservation' => false,
            'email_verified_at' => now()
        ]);
        User::create([
            'name' => 'bum manager',
            'email' => 'bum@manager.com',
            'password' => bcrypt('manager8um'),
            'role_master_id' => 2,
            'uker_master_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'has_facility' => true,
            'has_reservation' => true,
            'email_verified_at' => now()
        ]);
        User::create([
            'name' => 'Biro Umum',
            'email' => 'verifikator@verifikator.com',
            'password' => bcrypt('1234567890'),
            'role_master_id' => 3,
            'uker_master_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'has_facility' => true,
            'has_reservation' => false,
            'email_verified_at' => now()
        ]);
        User::create([
            'name' => 'bum verificator',
            'email' => 'bum@verifikator.com',
            'password' => bcrypt('verificator8um'),
            'role_master_id' => 3,
            'uker_master_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'has_facility' => false,
            'has_reservation' => false,
            'email_verified_at' => now()
        ]);
        User::create([
            'name' => 'Biro Umum',
            'email' => 'bum@bum.com',
            'password' => bcrypt('1234567890'),
            'role_master_id' => 4,
            'uker_master_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'has_facility' => true,
            'has_reservation' => false,
            'email_verified_at' => now()
        ]);
        User::create([
            'name' => 'Pusat Pendidikan dan Pelatihan',
            'email' => 'pusdiklat@pusdiklat.com',
            'password' => bcrypt('1234567890'),
            'role_master_id' => 2,
            'uker_master_id' => 57, // Assuming there is an existing UkerMaster with id 1
            'has_facility' => true,
            'has_reservation' => false,
            'email_verified_at' => now()
        ]);
        User::create([
            'name' => 'Direktorat Informasi dan Media',
            'email' => 'infomed@infomed.com',
            'password' => bcrypt('1234567890'),
            'role_master_id' => 4,
            'uker_master_id' => 38, // Assuming there is an existing UkerMaster with id 1
            'has_facility' => true,
            'has_reservation' => false,
            'email_verified_at' => now()
        ]);
        User::create([
            'name' => 'user trial',
            'email' => 'user@trial.com',
            'password' => bcrypt('user8um'),
            'role_master_id' => 4,
            'uker_master_id' => 38, // Assuming there is an existing UkerMaster with id 1
            'has_facility' => false,
            'has_reservation' => true,
            'email_verified_at' => now()
        ]);
    }
}