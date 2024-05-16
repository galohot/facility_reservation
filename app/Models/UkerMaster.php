<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkerMaster extends Model
{
    protected $fillable = ['satker_master_kd_satker', 'nama_unit_kerja_eselon_2'];

    public function satkerMaster()
    {
        return $this->belongsTo(SatkerMaster::class, 'satker_master_kd_satker', 'kd_satker');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }
}
