<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $data = Movie::with('trailers')->get();

        $content = [
            'success' => true,
            'data'    => $data,
        ];

        return response()->json($content, 200);
    }

    public function trailers($id)
    {
        $data = Movie::findOrFail($id)->trailers;

        $content = [
            'success' => true,
            'data'    => $data,
        ];

        return response()->json($content, 200);
    }

    public function store(StoreMovieRequest $request)
    {
        $request->user()->currentAccessToken()->delete();

        $data = Movie::create($request->all());

        $content = [
            'success' => true,
            'data'    => $data,
            'access_token' => auth()->user()->createToken('API Token')->plainTextToken,
            'token_type' => 'Bearer',
        ];
        return response()->json($content, 201);
    }

    public function show($id)
    {
        $data = Movie::with('trailers')->findOrFail($id);

        $content = [
            'success' => true,
            'data'    => $data,
        ];

        return response()->json($content, 200);
    }

    public function update(UpdateMovieRequest $request, $id)
    {
        $request->user()->currentAccessToken()->delete();

        $movie = Movie::findOrFail($id);

        $data = $request->only(['naam', 'functie_id', 'telefoon', 'email', 'sinds']);

        $content = [
            'success' => $movie->update($request->all()),
            'data'    => $data,
            'access_token' => auth()->user()->createToken('API Token')->plainTextToken,
            'token_type' => 'Bearer',
        ];
        return response()->json($content, 200);

        $movie = Movie::findOrFail($id);
        $movie->update($request->all());
        $movie->load('trailers');
        return response()->json($movie, 200);
    }

    public function destroy(Request $request, $id)
    {
        $request->user()->currentAccessToken()->delete();

        $movie = Movie::findOrFail($id);

        $movie->delete();

        $content = [
            'success' => true,
            'data'    => $movie,
            'access_token' => auth()->user()->createToken('API Token')->plainTextToken,
            'token_type' => 'Bearer',
        ];
        return response()->json($content, 202);
    }
}
