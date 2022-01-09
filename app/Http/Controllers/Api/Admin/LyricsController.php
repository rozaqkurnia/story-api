<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LyricsStoreRequest;
use App\Http\Resources\LyricsResource;
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
    public function index()
    {
        $lyrics = Lyrics::query()
            ->orderBy('id', 'ASC')
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
            ->paginate();

        return response(LyricsResource::collection($lyrics), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LyricsStoreRequest $request)
    {
        $input = $request->validated();
        $user = request()->user();

        $lyrics = $user->lyrics()->create($input);

        if (isset($validated['featured_image'])) {
            $lyrics->updateFeaturedImage($input['featured_image']);
        }
        $lyrics->genres()->sync($input['genre_ids']);
        $lyrics->artists()->attach($input['performer_ids'], ['role' => 'performer']);
        $lyrics->artists()->attach($input['performer_ids'], ['role' => 'composer']);
        $lyrics->artists()->attach($input['performer_ids'], ['role' => 'lyricist']);

        $meta = [];
        if (isset($input['meta_keywords'])) {
            $meta['keywords'] = $input['meta_keywords'];
        }
        if (isset($input['meta_description'])) {
            $meta['description'] = $input['meta_description'];
        }
        if (count($meta)) {
            $lyrics->meta()->create($meta);
        }

        return response(new LyricsResource($lyrics), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
