<?php

namespace Database\Seeders;

use App\Models\RoleMaster;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleMasterSeeder extends Seeder
{
    public function run()
    {
        RoleMaster::create([
            'role_str' => 'admin'
        ]);
        RoleMaster::create([
            'role_str' => 'manager'
        ]);
        RoleMaster::create([
            'role_str' => 'verificator'
        ]);
        RoleMaster::create([
            'role_str' => 'user'
        ]);
    }
}