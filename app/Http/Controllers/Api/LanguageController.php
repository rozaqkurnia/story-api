<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LanguageRequest;
use App\Http\Resources\LanguageResource;
use App\Models\Language;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::query()->paginate();
        return LanguageResource::collection($languages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageRequest $request)
    {
        $input = $request->validated();
        $language = new Language;
        $language->fill($input);
        $language->save();

        return LanguageResource::make($language);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = Language::where('id', $id)->firstOrFail();
        return LanguageResource::make($language);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, LanguageRequest $request)
    {
        $input = $request->validated();
        $language = Language::where('id', $id)->firstOrFail();
        $language->fill($input);
        $language->save();

        return LanguageResource::make($language);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language = Language::where('id', $id)->firstOrFail();
        $language->delete();

        return response()->noContent();
    }
}
