<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\FacilityCategory;
use App\Models\UkerMaster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run()
    {
        Facility::create([
            'name' => 'Contoh Ruang Rapat 1',
            'description' => 'Deskripsi contoh deskripsi ruang rapat 1',
            'floor' => 2,
            'uker_masters_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'facility_category_id' => 1, // Assuming there is an existing FacilityCategory with id 1
            'capacity' => 30,
            'location' => 'Pejambon',
            'image_main' => 'facilities/seeders/meeting/1.jpg',
            'image_1' => 'facilities/seeders/meeting/2.jpg',
            'image_2' => 'facilities/seeders/meeting/3.jpg',
            'image_3' => 'facilities/seeders/meeting/4.jpg',
            'google_map_link' => 'https://maps.app.goo.gl/2DHqfWx5tXHuxeVi8'

        ]);
        Facility::create([
            'name' => 'Contoh Ruang Rapat 2',
            'description' => 'Deskripsi contoh deskripsi ruang rapat 3',
            'floor' => 2,
            'uker_masters_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'facility_category_id' => 1, // Assuming there is an existing FacilityCategory with id 1
            'capacity' => 10,
            'location' => 'Pejambon',
            'image_main' => 'facilities/seeders/meeting/1.jpg',
            'image_1' => 'facilities/seeders/meeting/2.jpg',
            'image_2' => 'facilities/seeders/meeting/3.jpg',
            'image_3' => 'facilities/seeders/meeting/4.jpg',
            'google_map_link' => 'https://maps.app.goo.gl/2DHqfWx5tXHuxeVi8'
        ]);
        Facility::create([
            'name' => 'Contoh Aula/Venue/Hall 1',
            'description' => 'Deskripsi Contoh Aula/Venue/Hall 1',
            'floor' => 2,
            'uker_masters_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'facility_category_id' => 3, // Assuming there is an existing FacilityCategory with id 1
            'capacity' => 30,
            'location' => 'Pejambon',
            'image_main' => 'facilities/seeders/venue/1.jpeg',
            'image_1' => 'facilities/seeders/venue/2.jpg',
            'image_2' => 'facilities/seeders/venue/3.jpeg',
            'image_3' => 'facilities/seeders/venue/4.jpg',
            'google_map_link' => 'https://maps.app.goo.gl/n8UK1BJYyxGHwVnKA'
        ]);
        Facility::create([
            'name' => 'Contoh Aula/Venue/Hall 2',
            'description' => 'Deskripsi Contoh Aula/Venue/Hall 2',
            'floor' => 2,
            'uker_masters_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'facility_category_id' => 3, // Assuming there is an existing FacilityCategory with id 1
            'capacity' => 30,
            'location' => 'Pejambon Kantor Pusat',
            'image_main' => 'facilities/seeders/venue/1.jpeg',
            'image_1' => 'facilities/seeders/venue/2.jpg',
            'image_2' => 'facilities/seeders/venue/3.jpeg',
            'image_3' => 'facilities/seeders/venue/4.jpg',
            'google_map_link' => 'https://maps.app.goo.gl/n8UK1BJYyxGHwVnKA'
        ]);
        Facility::create([
            'name' => 'Contoh Lapangan 1',
            'description' => 'Deskripsi Contoh Lapangan 1',
            'floor' => 2,
            'uker_masters_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'facility_category_id' => 2, // Assuming there is an existing FacilityCategory with id 1
            'capacity' => 30,
            'location' => 'Pejambon Kantor Pusat',
            'image_main' => 'facilities/seeders/field/1.jpg',
            'image_1' => 'facilities/seeders/field/2.jpg',
            'image_2' => 'facilities/seeders/field/3.jpg',
            'image_3' => 'facilities/seeders/field/4.jpg',
            'google_map_link' => 'https://maps.app.goo.gl/n8UK1BJYyxGHwVnKA'
        ]);
        Facility::create([
            'name' => 'Contoh Lapangan 2',
            'description' => 'Deskripsi Contoh Lapangan 2',
            'floor' => 2,
            'uker_masters_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'facility_category_id' => 2, // Assuming there is an existing FacilityCategory with id 1
            'capacity' => 30,
            'location' => 'Pejambon Kantor Pusat',
            'image_main' => 'facilities/seeders/field/1.jpg',
            'image_1' => 'facilities/seeders/field/2.jpg',
            'image_2' => 'facilities/seeders/field/3.jpg',
            'image_3' => 'facilities/seeders/field/4.jpg',
            'google_map_link' => 'https://maps.app.goo.gl/n8UK1BJYyxGHwVnKA'
        ]);
        Facility::create([
            'name' => 'Contoh bus 2',
            'description' => 'Deskripsi bus 2',
            'floor' => 2,
            'uker_masters_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'facility_category_id' => 4, // Assuming there is an existing FacilityCategory with id 1
            'capacity' => 30,
            'location' => 'Pejambon Kantor Pusat',
            'image_main' => 'facilities/seeders/bus/1.jpg',
            'image_1' => 'facilities/seeders/bus/2.jpg',
            'image_2' => 'facilities/seeders/bus/3.jpg',
            'image_3' => 'facilities/seeders/bus/4.jpg',
            'google_map_link' => 'https://maps.app.goo.gl/n8UK1BJYyxGHwVnKA'
        ]);
        Facility::create([
            'name' => 'Contoh Minibus',
            'description' => 'Deskripsi Contoh Minibus',
            'floor' => 2,
            'uker_masters_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'facility_category_id' => 5, // Assuming there is an existing FacilityCategory with id 1
            'capacity' => 30,
            'location' => 'Pejambon Kantor Pusat',
            'image_main' => 'facilities/seeders/minibus/1.jpg',
            'image_1' => 'facilities/seeders/minibus/2.jpg',
            'image_2' => 'facilities/seeders/minibus/3.jpg',
            'image_3' => 'facilities/seeders/minibus/4.jpg',
            'google_map_link' => 'https://maps.app.goo.gl/n8UK1BJYyxGHwVnKA'
        ]);
        Facility::create([
            'name' => 'Contoh Mobil 1',
            'description' => 'Deskripsi Contoh Mobil 1',
            'floor' => 2,
            'uker_masters_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'facility_category_id' => 6, // Assuming there is an existing FacilityCategory with id 1
            'capacity' => 30,
            'location' => 'Pejambon Kantor Pusat',
            'image_main' => 'facilities/seeders/car/1.jpg',
            'image_1' => 'facilities/seeders/car/2.jpg',
            'image_2' => 'facilities/seeders/car/3.jpg',
            'image_3' => 'facilities/seeders/car/4.jpg',
            'google_map_link' => 'https://maps.app.goo.gl/n8UK1BJYyxGHwVnKA'
        ]);
        Facility::create([
            'name' => 'Contoh Mobil 2',
            'description' => 'Deskripsi Contoh Mobil 2',
            'floor' => 2,
            'uker_masters_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'facility_category_id' => 6, // Assuming there is an existing FacilityCategory with id 1
            'capacity' => 30,
            'location' => 'Pejambon Kantor Pusat',
            'image_main' => 'facilities/seeders/car/1.jpg',
            'image_1' => 'facilities/seeders/car/2.jpg',
            'image_2' => 'facilities/seeders/car/3.jpg',
            'image_3' => 'facilities/seeders/car/4.jpg',
            'google_map_link' => 'https://maps.app.goo.gl/n8UK1BJYyxGHwVnKA'
        ]);
        Facility::create([
            'name' => 'Contoh Zoom',
            'description' => 'Deskripsi Zoom',
            'floor' => 2,
            'uker_masters_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'facility_category_id' => 7, // Assuming there is an existing FacilityCategory with id 1
            'capacity' => 30,
            'location' => 'Pejambon Kantor Pusat',
            'image_main' => 'facilities/seeders/zoom/1.jpeg',
            'image_1' => 'facilities/seeders/zoom/2.jpeg',
            'image_2' => 'facilities/seeders/zoom/3.jpeg',
            'image_3' => 'facilities/seeders/zoom/4.jpeg',
            'google_map_link' => 'https://maps.app.goo.gl/n8UK1BJYyxGHwVnKA'
        ]);
        Facility::create([
            'name' => 'Contoh sound system',
            'description' => 'Deskripsi Contoh sound system',
            'floor' => 2,
            'uker_masters_id' => 6, // Assuming there is an existing UkerMaster with id 1
            'facility_category_id' => 8, // Assuming there is an existing FacilityCategory with id 1
            'capacity' => 30,
            'location' => 'Pejambon Kantor Pusat',
            'image_main' => 'facilities/seeders/sound/1.jpeg',
            'image_1' => 'facilities/seeders/sound/2.jpeg',
            'image_2' => 'facilities/seeders/sound/3.jpeg',
            'image_3' => 'facilities/seeders/sound/4.jpeg',
            'google_map_link' => 'https://maps.app.goo.gl/n8UK1BJYyxGHwVnKA'
        ]);
    }
}