<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempleImage extends Model
{
    use HasFactory;

    protected $fillable = ['temple_id', 'image_url','image_name'];

    public function temple()
    {
        return $this->belongsTo(Temple::class);
    }
}

