<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'temple_id', 'amount', 'receipt_number','donation_date','transaction_id','payment_method','donation_date','invoice','invoice_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userDetails()
    {
        return $this->belongsTo(UserDetails::class);
    }

    public function temple()
    {
        return $this->belongsTo(Temple::class);
    }

}
