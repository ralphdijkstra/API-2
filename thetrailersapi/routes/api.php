<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\TrailerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

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

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/logout', [AuthenticationController::class, 'logout']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile', function (Request $request) {
        return auth()->user();
    });

    Route::apiResource('movies', MovieController::class)->except(['index', 'show']);
    Route::apiResource('trailers', TrailerController::class)->except(['index', 'show']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('movies', MovieController::class)->only(['index', 'show']);
Route::get('movies/{movie}/trailers', [MovieController::class, 'trailers']);

Route::apiResource('trailers', TrailerController::class)->only(['index', 'show']);
