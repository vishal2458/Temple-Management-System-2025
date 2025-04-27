<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DarshanTime extends Model
{
    use HasFactory;

    protected $fillable = ['temple_id', 'date', 'from', 'to'];

    public function temple()
    {
        return $this->belongsTo(Temple::class);
    }
}

