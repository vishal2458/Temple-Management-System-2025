<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtiTime extends Model
{
    use HasFactory;

    protected $fillable = ['temple_id', 'date', 'time'];

    public function temple()
    {
        return $this->belongsTo(Temple::class);
    }
}
