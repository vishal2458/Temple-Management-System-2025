<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $table = 'user_details';
    protected $fillable = [
        'user_id', 'address', 'religion', 'dob', 'pincode', 'city_id', 'state_id',
        'country_id', 'adhar_card_number', 'adhar_card_image', 'pan_card_number',
        'pan_card_image', 'passport_number', 'passport_image'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

}
