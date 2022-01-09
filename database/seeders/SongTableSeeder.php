<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SongTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $songs = DB::connection('mysql_old')
            ->table('lyrics')
            ->get();

        $songs->each(function ($item, $key) {
            DB::table('songs')->insert([
                'id' => $item->id,
                'name' => $item->song,
                'title' => $item->title,
                'slug' => $item->slug,
                'known_as' => $item->aka,
                'excerpt' => $item->short_description,
                'release_year' => $item->year,
                'original' => $item->original,
                'romanized' => $item->romaji,
                'featured_image' => $item->featured_image_path,
                'is_collaboration' => $item->collaboration,
                'is_featuring' => $item->featuring,
                'is_published' => true,
                'published_at' => $item->created_at,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'user_id' => 1,
            ]);

            $title = Str::of($item->title)->before('-') . $item->album;
            DB::table('albums')->insertOrIgnore([
                'title' => $title,
                'name' => $item->album,
                'slug' => Str::slug($title),
                'country_id' => $item->country_id,
                'release_year' => $item->year,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('song_language')->insert([
                'song_id' => $item->id,
                'language_id' => $item->language_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        $artists = DB::connection('mysql_old')
            ->table('lyrics_artist')
            ->get();

        $artists->each(function ($item, $key) {
            DB::table('song_artist')->insert([
                'song_id' => $item->lyrics_id,
                'artist_id' => $item->artist_id,
                'as' => $item->role == 'lyricist' ? 'songwriter' : $item->role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        $genres = DB::connection('mysql_old')
            ->table('lyrics_genre')
            ->get();

        $genres->each(function ($item, $key) {
            DB::table('song_genre')->insert([
                'song_id' => $item->lyrics_id,
                'genre_id' => $item->genre_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
