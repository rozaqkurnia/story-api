<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\SongController;
use App\Http\Controllers\Api\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('resources', HomeController::class);
Route::apiResource('artists', ArtistController::class)->only(['index', 'show']);
Route::apiResource('countries', CountryController::class)->only(['index', 'show']);
Route::apiResource('genres', GenreController::class)->only(['index', 'show']);
Route::apiResource('languages', LanguageController::class)->only(['index', 'show']);
Route::apiResource('songs', SongController::class)->only(['index', 'show']);