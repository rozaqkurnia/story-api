<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Genre;
use App\Models\Artist;
use App\Http\Resources\AsTagResource;
use App\Http\Resources\SongCardResource;

class HomeController extends Controller
{
    public function __invoke()
    {
        $songs = Song::query()
            ->with('performers', 'songwriters', 'composers', 'genres', 'user')
            ->withCount('likes', 'comments')
            ->take(10)
            ->get();
        $genres = Genre::query()
            ->whereHas('songs')
            ->get();
        $artists = Artist::query()
            ->whereHas('performings')
            ->get();

        return response()->json([
            'data' => [
                'songs' => SongCardResource::collection($songs),
                'genres' => AsTagResource::collection($genres),
                'artists' => AsTagResource::collection($artists),
            ],
        ], 200);
    }
}
