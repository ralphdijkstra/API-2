<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrailerRequest;
use App\Http\Requests\UpdateTrailerRequest;
use Illuminate\Http\Request;
use App\Models\Trailer;

class TrailerController extends Controller
{
    public function index()
    {
        $trailers = Trailer::with('movie')->get();
        return response()->json($trailers);
    }

    public function store(StoreTrailerRequest $request)
    {
        $request->user()->currentAccessToken()->delete();

        $data = Trailer::create($request->all());

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
        $trailer = Trailer::with('movie')->findOrFail($id);
        return response()->json($trailer);
    }

    public function update(UpdateTrailerRequest $request, $id)
    {
        $request->user()->currentAccessToken()->delete();

        $trailer = Trailer::findOrFail($id);

        $data = $request->only(['title', 'year']);

        $content = [
            'success' => $trailer->update($request->all()),
            'data'    => $data,
            'access_token' => auth()->user()->createToken('API Token')->plainTextToken,
            'token_type' => 'Bearer',
        ];
        return response()->json($content, 200);
    }

    public function destroy(Request $request, $id)
    {
        $request->user()->currentAccessToken()->delete();

        $trailer = Trailer::findOrFail($id);

        $trailer->delete();

        $content = [
            'success' => true,
            'data'    => $trailer,
            'access_token' => auth()->user()->createToken('API Token')->plainTextToken,
            'token_type' => 'Bearer',
        ];
        return response()->json($content, 202);
    }
}
