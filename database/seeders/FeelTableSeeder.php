<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feels')->insert([
            ['name' => 'clap', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'funny', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'love', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'sad', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'scary', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
