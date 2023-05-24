<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\TrailerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('movies', MovieController::class);
Route::get('movies/{movie}/trailers', [MovieController::class, 'trailers']);

Route::resource('trailers', TrailerController::class);
