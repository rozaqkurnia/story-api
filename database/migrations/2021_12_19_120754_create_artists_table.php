<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Artist;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->mediumText('short_description')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Artist::create([
            'name' => 'Ayase',
            'slug' => 'ayase',
        ]);
        Artist::create([
            'name' => 'YOASOBI', 
            'slug' => 'yoasobi',
        ]);
        Artist::create([
            'name' => 'Aimyon', 
            'slug' => 'aimyon',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artists');
    }
}
