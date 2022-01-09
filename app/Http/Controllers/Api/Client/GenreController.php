<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenreCardResource;
use App\Http\Resources\LyricsCardResource;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use App\Models\Lyrics;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page=null)
    {
        $take = 10;
        if ($page == null) {
            $page = 1;
        }
        $skip = ($page*$take) -$take;
        $prev = null;
        $next = null;
        if ($skip > 0) {
            $prev = $page - 1;
        }

        $genres = Genre::query()
            ->orderBy('name', 'DESC')
            ->skip($skip)
            ->take($take)
            ->get();

        if ($genres->count() >= $take) {
            $next = $page + 1;
        }

        return response([
            'data' => GenreCardResource::collection($genres),
            'prev' => $prev,
            'next' => $next,
        ], Response::HTTP_OK);
    }

    public function show($slug, $page=null)
    {
        $take = 10;
        if ($page == null) {
            $page = 1;
        }
        $skip = ($page*$take) -$take;
        $prev = null;
        $next = null;
        if ($skip > 0) {
            $prev = $page - 1;
        }

        $genre = Genre::query()
            ->where('slug', $slug)
            ->first();

        $lyrics = Lyrics::query()
            ->whereHas('genres', function ($query) use ($genre) {
                $query->where('genre_id', $genre->id);
            })
            ->orderBy('year', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->skip($skip)
            ->take($take)
            ->get();

        if ($lyrics->count() >= $take) {
            $next = $page + 1;
        }

        if (! $genre) {
            return response(null, Response::HTTP_NOT_FOUND);
        }

        return response([
            'genre' => new GenreResource($genre),
            'lyrics' => LyricsCardResource::collection($lyrics),
            'prev' => $prev,
            'next' => $next,
        ], Response::HTTP_OK);
    }
}
