<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = DB::connection('mysql_old')
            ->table('languages')
            ->get();
        
        $languages->each(function ($item, $key) {
            DB::table('languages')->insert([
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $item->slug,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }); 
    }
}
