<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temple extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'city', 'state' , 'country' ,'address','live_darshan','description' , 'main_image','season'
    ];


    public function images()
    {
        return $this->hasMany(TempleImage::class);
    }

    public function darshanTimes()
    {
        return $this->hasMany(DarshanTime::class);
    }

    public function artiTimes()
    {
        return $this->hasMany(ArtiTime::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function festivals()
    {
        return $this->hasMany(Festival::class);
    }
}
