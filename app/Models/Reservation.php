<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['user_id','facility_id', 'event', 'reservation_start', 'reservation_end', 'status', 'description','document','document_attachment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    protected function casts(): array
    {
        return [
            'reservation_start' => 'datetime',
            'reservation_end' => 'datetime',
        ];
    }

}
