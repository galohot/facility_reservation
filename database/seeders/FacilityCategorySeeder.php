<?php

namespace Database\Seeders;

use App\Models\FacilityCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilityCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        FacilityCategory::create([
            'category_str' => 'Ruang Rapat'
        ]);
        FacilityCategory::create([
            'category_str' => 'Lapangan'
        ]);
        FacilityCategory::create([
            'category_str' => 'Aula'
        ]);
        FacilityCategory::create([
            'category_str' => 'Bus'
        ]);
        FacilityCategory::create([
            'category_str' => 'Mini Bus'
        ]);
        FacilityCategory::create([
            'category_str' => 'Mobil'
        ]);
        FacilityCategory::create([
            'category_str' => 'Peralatan Zoom'
        ]);
        FacilityCategory::create([
            'category_str' => 'Sound System'
        ]);
    }
}