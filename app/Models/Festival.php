<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'start_date', 'temple_id','end_date','festival_desc','festival_image'
    ];

    public function temple()
    {
        return $this->belongsTo(Temple::class);
    }
}
