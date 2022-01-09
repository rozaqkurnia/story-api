<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $metas = DB::connection('mysql_old')
            ->table('metas')
            ->get();

        $metas->each(function ($item, $key) {
            DB::table('metas')->insert([
                'id' => $item->id,
                'resource_id' => $item->post_id,
                'resource_type' => $item->post_type === 'lyrics' ? 'song' : $item->post_type,
                'keywords' => $item->keywords,
                'description' => $item->description,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        });
    }
}
