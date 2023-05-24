<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trailer extends Model
{
    protected $fillable = ['title', 'url', 'movie_id'];
    
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
