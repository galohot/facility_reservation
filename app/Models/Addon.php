<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;

    protected $fillable = ['addon_str','description'];

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'facility_addons');
    }
}