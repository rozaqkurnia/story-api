<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GenreRequest;
use App\Http\Resources\GenreResource;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::query()->paginate();
        return GenreResource::collection($genres);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenreRequest $request)
    {
        $input = $request->validated();
        $genre = new Genre;
        $genre->fill($input);
        $genre->save();

        return GenreResource::make($genre);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $genre = Genre::where('id', $id)->firstOrFail();
        return GenreResource::make($genre);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, GenreRequest $request)
    {
        $input = $request->validated();
        $genre = Genre::where('id', $id)->firstOrFail();
        $genre->fill($input);
        $genre->save();

        return GenreResource::make($genre);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Genre::where('id', $id)->firstOrFail();
        $genre->delete();

        return response()->noContent();
    }
}
