<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('name');
            $table->unsignedInteger('number')->nullable();
            $table->string('known_as')->nullable();
            $table->date('release_date')->nullable();
            $table->year('release_year')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('original')->nullable();
            $table->text('romanized')->nullable();
            $table->string('featured_image')->nullable();
            $table->unsignedBigInteger('album_id')->nullable();
            $table->unsignedInteger('disc_number')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_collaboration')->default(false);
            $table->boolean('is_featuring')->default(false);
            $table->boolean('is_draft')->default(false);
            $table->boolean('is_published')->default(false);
            $table->datetime('published_at')->nullable();
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
        Schema::dropIfExists('songs');
    }
}
