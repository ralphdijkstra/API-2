<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title', 'year', 'poster_url'];

    public function trailers()
    {
        return $this->hasMany(Trailer::class);
    }
}
