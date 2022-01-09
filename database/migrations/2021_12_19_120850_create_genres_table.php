<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Genre;

class CreateGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
        });

        Genre::create([
            'name' => 'Pop',
            'slug' => 'pop',
        ]);
        Genre::create([
            'name' => 'Rock',
            'slug' => 'rock',
        ]);
        Genre::create([
            'name' => 'RnB',
            'slug' => 'rnb',
        ]);
        Genre::create([
            'name' => 'J-Pop',
            'slug' => 'j-pop',
        ]);
        Genre::create([
            'name' => 'K-Pop',
            'slug' => 'k-pop',
        ]);
        Genre::create([
            'name' => 'Hip Hop',
            'slug' => 'hip-hop',
        ]);
        Genre::create([
            'name' => 'Dance / Elektronik',
            'slug' => 'dance-elektronik',
        ]);
        Genre::create([
            'name' => 'Jazz',
            'slug' => 'jazz',
        ]);
        Genre::create([
            'name' => 'Punk',
            'slug' => 'punk',
        ]);
        Genre::create([
            'name' => 'Metal',
            'slug' => 'metal',
        ]);
        Genre::create([
            'name' => 'Heavy Metal',
            'slug' => 'heavy-metal',
        ]);
        Genre::create([
            'name' => 'Anime',
            'slug' => 'anime',
        ]);
        Genre::create([
            'name' => 'Alternative',
            'slug' => 'alternative',
        ]);
        Genre::create([
            'name' => 'Indie',
            'slug' => 'indie',
        ]);
        Genre::create([
            'name' => 'Vocaloid',
            'slug' => 'vocaloid',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genres');
    }
}
