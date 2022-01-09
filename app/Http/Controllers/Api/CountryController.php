<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CountryRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::query()->paginate();
        return CountryResource::collection($countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $input = $request->validated();
        $country = new Country;
        $country->fill($input);
        $country->save();

        return CountryResource::make($country);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::where('id', $id)->firstOrFail();
        return CountryResource::make($country);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, CountryRequest $request)
    {
        $input = $request->validated();
        $country = Country::where('id', $id)->firstOrFail();
        $country->fill($input);
        $country->save();

        return CountryResource::make($country);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::where('id', $id)->firstOrFail();
        $country->delete();

        return response()->noContent();
    }
}
