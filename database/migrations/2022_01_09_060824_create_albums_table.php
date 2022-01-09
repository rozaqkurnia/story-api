<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('name');
            $table->string('known_as')->nullable();
            $table->string('featured_image')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('total_song')->nullable();
            $table->unsignedBigInteger('artist_id');
            $table->unsignedBigInteger('country_id');
            $table->date('release_date')->nullable();
            $table->year('release_year')->nullable();
            $table->boolean('is_draft')->default(true);
            $table->boolean('is_published')->deafult(false);
            $table->datetime('published_at')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
    }
}
