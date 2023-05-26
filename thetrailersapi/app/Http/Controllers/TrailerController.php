<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trailer;

class TrailerController extends Controller
{
    public function index()
    {
        $trailers = Trailer::with('movie')->get();
        return response()->json($trailers);
    }

    public function store(Request $request)
    {
        $trailer = Trailer::create($request->all());
        return response()->json($trailer, 201);
    }

    public function show($id)
    {
        $trailer = Trailer::with('movie')->findOrFail($id);
        return response()->json($trailer);
    }

    public function update(Request $request, $id)
    {
        $trailer = Trailer::findOrFail($id);
        $trailer->update($request->all());
        return response()->json($trailer);
    }

    public function destroy($id)
    {
        $trailer = Trailer::findOrFail($id);
        $trailer->delete();
        return response()->json(null, 200);
    }
}
