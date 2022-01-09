<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLyricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lyrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id');
            $table->foreignId('language_id');
            $table->string('title');
            $table->string('slug');
            $table->string('song');
            $table->string('aka')->nullable();
            $table->string('album')->nullable();
            $table->year('year')->nullable();
            $table->string('featured_image_path')->nullable();
            $table->mediumText('short_description')->nullable();
            $table->text('romaji')->nullable();
            $table->text('original')->nullable();
            $table->text('en_translation')->nullable();
            $table->text('id_translation')->nullable();
            $table->foreignId('user_id');
            $table->boolean('collaboration')->default(false);
            $table->boolean('featuring')->default(false);
            $table->timestamps();

            $table->index(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lyrics');
    }
}
