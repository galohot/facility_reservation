<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityCategory extends Model
{
    protected $fillable = ['category_str'];

    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }
}
