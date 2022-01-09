<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = DB::connection('mysql_old')
            ->table('genres')
            ->get();

        $genres->each(function ($item, $key){
            DB::table('genres')->insert([
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $item->slug,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
