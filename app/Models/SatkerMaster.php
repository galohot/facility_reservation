<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatkerMaster extends Model
{

    protected $fillable = ['kd_satker','nama_satker'];

    public function ukerMasters()
    {
        return $this->hasMany(UkerMaster::class, 'satker_master_kd_satker', 'kd_satker');
    }
}