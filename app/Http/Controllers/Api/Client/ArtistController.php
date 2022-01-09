<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArtistCardResource;
use App\Http\Resources\LyricsCardResource;
use App\Http\Resources\ArtistResource;
use App\Models\Artist;
use App\Models\Lyrics;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArtistController extends Controller
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

        $artists = Artist::query()
            ->orderBy('created_at', 'DESC')
            ->with([
                'countries',
            ])
            ->skip($skip)
            ->take($take)
            ->get();

        if ($artists->count() >= $take) {
            $next = $page + 1;
        }

        return response([
            'data' => ArtistCardResource::collection($artists),
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

        $artist = Artist::query()
            ->where('slug', $slug)
            ->with([
                'countries',  
                'meta',
            ])
            ->first();

        $lyrics = Lyrics::query()
            ->whereHas('performers', function ($query) use ($artist) {
                $query->where('artist_id', $artist->id);
            })->orWhereHas('composers', function ($query) use ($artist) {
                $query->where('artist_id', $artist->id);
            })->orWhereHas('lyricists', function ($query) use ($artist) {
                $query->where('artist_id', $artist->id);
            })
            ->orderBy('year', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->skip($skip)
            ->take($take)
            ->get();

        if ($lyrics->count() >= $take) {
            $next = $page + 1;
        }

        if (! $artist) {
            return response(null, Response::HTTP_NOT_FOUND);
        }

        return response([
            'artist' => new ArtistResource($artist),
            'lyrics' => LyricsCardResource::collection($lyrics),
            'prev' => $prev,
            'next' => $next,
        ], Response::HTTP_OK);
    }
}
