<?php

namespace Database\Seeders;

use App\Models\Movie;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing records in the table
        Movie::truncate();

        $moviesData = [
            [
                'title' => 'Guardians of the Galaxy vol. 3',
                'year' => '2023',
            ],
            [
                'title' => 'Spider-Man: Across the Spider-Verse',
                'year' => '2023',
            ],
        ];

        $client = new Client();
        $apiKey = 'bc72560d';

        foreach ($moviesData as $movieData) {
            $response = $client->get("http://www.omdbapi.com/?t={$movieData['title']}&y={$movieData['year']}&apikey={$apiKey}");
            $data = json_decode($response->getBody(), true);
                $movie = Movie::create([
                    'title' => $data['Title'],
                    'year' => $data['Year'],
                    'poster_url' => $data['Poster'],
                ]);
        }
    }
}
