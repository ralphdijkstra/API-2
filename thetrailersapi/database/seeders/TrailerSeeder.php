<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trailer;

class TrailerSeeder extends Seeder
{
    public function run()
    {
        Trailer::create([
            'title' => 'Official Trailer',
            'url' => '32RAq6JzY-w',
            'movie_id' => '1'
        ]);
        Trailer::create([
            'title' => 'Main Trailer',
            'url' => '32RAq6JzY-w',
            'movie_id' => '1'
        ]);
    }
}
