<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title', 'year'];

    public function trailers()
    {
        return $this->hasMany(Trailer::class);
    }
}
