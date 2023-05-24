<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with('trailers')->get();
        return response()->json($movies);
    }

    public function trailers($id)
    {
        $movie = Movie::findOrFail($id);
        $trailers = $movie->trailers;

        return response()->json($trailers);
    }

    public function store(Request $request)
    {
        $movie = Movie::create($request->all());
        $movie->load('trailers');
        return response()->json($movie, 201);
    }

    public function show($id)
    {
        $movie = Movie::with('trailers')->findOrFail($id);
        return response()->json($movie);
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->update($request->all());
        $movie->load('trailers');
        return response()->json($movie);
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return response()->json(null, 204);
    }
}
