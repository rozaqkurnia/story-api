<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\LyricsStoreRequest;
use App\Http\Resources\LyricsCardResource;
use App\Http\Resources\LyricsResource;
use App\Models\Artist;
use App\Models\Lyrics;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LyricsController extends Controller
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

        $lyrics = Lyrics::query()
            ->orderBy('year', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->with([
                'performers',
                'composers',
                'lyricists',
                'genres',
                'language',
                'country',
                'user',
                'meta',
            ])
            ->skip($skip)
            ->take($take)
            ->get();

        if ($lyrics->count() >= $take) {
            $next = $page + 1;
        }

        return response([
            'data' => LyricsCardResource::collection($lyrics),
            'prev' => $prev,
            'next' => $next,
        ], Response::HTTP_OK);
    }

    public function show($slug)
    {
        $lyrics = Lyrics::query()
            ->where('slug', $slug)
            ->first();

        if (! $lyrics) {
            return response(null, Response::HTTP_NOT_FOUND);
        }

        return response(new LyricsResource($lyrics), Response::HTTP_OK);
    }

    public function getIndex()
    {
      $lyrics = Lyrics::query()
        ->select('title','slug', 'updated_at')
        ->orderBy('slug')
        ->get()
        ->map(function ($item) {
          $item = collect([
            'slug' => $item->slug,
            'updatedAt' => $item->updated_at->tz('UTC')->toAtomString(),
          ]);
          return $item;
        });
      return response([ 'data' => $lyrics ], Response::HTTP_OK);
    }

    public function getIndexArtists()
    {
      $artists = Artist::query()
        ->select('name', 'slug', 'updated_at')
        ->orderBy('slug')
        ->whereHas('lyrics')
        ->get()
        ->map(function ($item) {
          $item = collect([
            'slug' => $item->slug,
            'updatedAt' => $item->updated_at->tz('UTC')->toAtomString(),
          ]);

        return $item;
      });
      return response(['data' => $artists], Response::HTTP_OK);
    }

    public function getIndexByArtist($artist)
    {
      $lyrics = Lyrics::query()
      ->select('title', 'slug', 'updated_at')
      ->whereHas('performers', function ($query) use ($artist) {
        return $query->where('slug', $artist);
      })->orWhereHas('composers', function ($query) use ($artist) {
        return $query->where('slug', $artist);
      })->whereHas('lyricists', function ($query) use ($artist) {
        return $query->where('slug', $artist);
      })
      ->get()
      ->map(function ($item) {
        $item = collect([
          'slug'=> $item->slug,
          'updatedAt' => $item->updated_at->tz('UTC')->toAtomString(),
        ]);

        return $item;
      });
      return response(['data' => $lyrics], Response::HTTP_OK);
    }

    public function getIndexByLetter($letter)
    {
      $lyrics = Lyrics::query()
      ->select('title', 'slug', 'updated_at')
      ->where('title', 'LIKE', "{$letter}%")
      ->get()
      ->map(function ($item) {
        $item = collect([
          'slug' => $item->slug,
          'updatedAt' => $item->updated_at->tz('UTC')->toAtomString(),
        ]);
        return $item;
      });
      return response(['data' => $lyrics], Response::HTTP_OK);
    }
}
