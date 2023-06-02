<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MoviesTest extends TestCase
{
    public function test_movie_on_id()
    {
        $response = $this->get('api/movies/1');

        $response
            ->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.title', 'Fast X')
            ->assertJsonPath('data.year', '2023');
    }

    public function test_insert_movie()
    {
        Sanctum::actingAs(User::factory()->create(), ['*']);

        $data = ['title' => 'Avengers: Endgame', 'year' => '2019'];
        $response = $this->json('POST', 'api/movies', $data);

        $this->assertDatabaseHas(
            'movies',
            ['title' => 'Avengers: Endgame', 'year' => '2019',]
        );

        $response
            ->assertStatus(201)
            ->assertJsonPath('data.title', 'Avengers: Endgame')
            ->assertJsonPath('data.year', '2019');
    }

    public function test_delete_movie()
    {
        Sanctum::actingAs(User::factory()->create(), ['*']);
        
        $response = $this->delete('api/movies/1');
        $response->assertStatus(202);
    }
}
