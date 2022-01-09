<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artists = DB::connection('mysql_old')
            ->table('artists')
            ->get();

        $artists->each(function ($item, $key) {
            DB::table('artists')->insert([
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $item->slug,
                'title' => $item->name,
                'excerpt' => $item->short_description,
                'description' => $item->description,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'user_id' => 1,
            ]);
        });

        $countries = DB::connection('mysql_old')
            ->table('artist_country')
            ->get();

        $countries->each(function ($item, $key) {
            DB::table('artist_country')->insert([
                'id' => $item->id,
                'artist_id' => $item->artist_id,
                'country_id' => $item->country_id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        });
    }
}
