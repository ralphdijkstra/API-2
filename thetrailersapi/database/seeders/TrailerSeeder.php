<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trailer;

class TrailerSeeder extends Seeder
{
    public function run()
    {
        Trailer::create([
            'title' => 'FAST X | Official Trailer',
            'url' => '32RAq6JzY-w',
            'movie_id' => '1'
        ]);
        Trailer::create([
            'title' => 'FAST X | Official Trailer 2',
            'url' => 'aOb15GVFZxU',
            'movie_id' => '1'
        ]);
        Trailer::create([
            'title' => 'FAST X | Final Trailer',
            'url' => 'eoOaKN4qCKw',
            'movie_id' => '1'
        ]);
        Trailer::create([
            'title' => 'SPIDER-MAN: ACROSS THE SPIDER-VERSE - First Look',
            'url' => 'BbXJ3_AQE_o',
            'movie_id' => '2'
        ]);
        Trailer::create([
            'title' => 'SPIDER-MAN: ACROSS THE SPIDER-VERSE - Official Trailer (HD)',
            'url' => 'cqGjhVJWtEg',
            'movie_id' => '2'
        ]);
        Trailer::create([
            'title' => 'SPIDER-MAN: ACROSS THE SPIDER-VERSE - Official Trailer #2 (HD)',
            'url' => 'shW9i6k8cB0',
            'movie_id' => '2'
        ]);
        Trailer::create([
            'title' => 'The Flash - Official Trailer',
            'url' => 'hebWYacbdvc',
            'movie_id' => '3'
        ]);
        Trailer::create([
            'title' => 'The Flash - Official Trailer 2',
            'url' => 'r51cYVZWKdY',
            'movie_id' => '3'
        ]);
        Trailer::create([
            'title' => 'THE FLASH - FINAL TRAILER',
            'url' => 'jprhe-cWKGs',
            'movie_id' => '3'
        ]);
    }
}
