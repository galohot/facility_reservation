<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityAddon extends Model
{
    use HasFactory;
    protected $fillable = ['facility_addons'];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
