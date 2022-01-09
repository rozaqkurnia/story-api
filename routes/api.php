<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\ArtistController;
use App\Http\Controllers\Api\Admin\CountryController;
use App\Http\Controllers\Api\Admin\LanguageController;
use App\Http\Controllers\Api\Admin\LyricsController;
use App\Http\Controllers\Api\Client\LyricsController as ClientLyrics;
use App\Http\Controllers\Api\Client\ArtistController as ClientArtist;
use App\Http\Controllers\Api\Client\GenreController as ClientGenre;

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

Route::get('lyrics', [ClientLyrics::class, 'index']);
Route::get('lyrics/index', [ClientLyrics::class, 'getIndex']);
Route::get('lyrics/index/artists', [ClientLyrics::class, 'getIndexArtists']);
Route::get('lyrics/index/artists/{artist}', [ClientLyrics::class, 'getIndexByArtist']);
Route::get('lyrics/index/letters/{letter}', [ClientLyrics::class, 'getIndexByLetter']);
Route::get('lyrics/page/{page}', [ClientLyrics::class, 'index']);
Route::get('lyrics/{slug}', [ClientLyrics::class, 'show']);

Route::get('artists', [ClientArtist::class, 'index']);
Route::get('artist/{slug}', [ClientArtist::class, 'show']);
Route::get('artist/{slug}/page/{page}', [ClientArtist::class, 'show']);

Route::get('genres', [ClientGenre::class, 'index']);
Route::get('genre/{slug}', [ClientGenre::class, 'show']);
Route::get('genre/{slug}/page/{page}', [ClientGenre::class, 'show']);
