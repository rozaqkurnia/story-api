<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = DB::connection('mysql_old')
            ->table('countries')
            ->get();

        $countries->each(function($item, $key) {
            DB::table('countries')->insert([
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $item->slug,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
