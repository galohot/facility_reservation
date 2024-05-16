<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'role_master_id','uker_master_id', 'has_facility', 'has_reservation'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function ukerMaster()
    {
        return $this->belongsTo(UkerMaster::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function roleMaster()
    {
        return $this->belongsTo(RoleMaster::class);
    }

    public function hasRole($role)
    {
        return $this->roleMaster && $this->roleMaster->role_str === $role;
    }
    public function hasUker($ukerId)
    {
        return $this->ukerMaster && $this->ukerMaster->id === $ukerId;
    }

    public function getUserInfo()
    {
        return [
            'name' => $this->name,
            'role_str' => $this->roleMaster->role_str,
            'id' => $this->id
        ];
    }

}
