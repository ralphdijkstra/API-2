<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use Illuminate\Http\Request;
use App\Models\Movie;
use GuzzleHttp\Client;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with('trailers')->get();
        return response()->json($movies, 200);
    }

    public function trailers($id)
    {
        $movie = Movie::findOrFail($id);
        $trailers = $movie->trailers;
        return response()->json($trailers, 200);
    }

    public function store(StoreMovieRequest $request)
    {
        $movie = Movie::create($request->all());
        return response()->json($movie, 201);
    }

    public function show($id)
    {
        $movie = Movie::with('trailers')->findOrFail($id);
        return response()->json($movie, 200);
    }

    public function update(UpdateMovieRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->update($request->all());
        $movie->load('trailers');
        return response()->json($movie, 200);
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return response()->json('Movie deleted successfully.', 204);
    }
}
