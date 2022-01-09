<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('known_as')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->string('featured_image')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_draft')->default(true);
            $table->boolean('is_published')->default(false);
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
        Schema::dropIfExists('artists');
    }
}
