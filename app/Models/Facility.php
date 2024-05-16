<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = ['name', 'description', 'capacity','floor','image_main','image_1','image_2','image_3','location','google_map_link', 'uker_masters_id', 'facility_category_id'];

    public function ukerMaster()
    {
        return $this->belongsTo(UkerMaster::class, 'uker_masters_id');
    }

    public function facilityCategory()
    {
        return $this->belongsTo(FacilityCategory::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function facilityAddons()
    {
        return $this->hasMany(FacilityAddon::class);
    }
}