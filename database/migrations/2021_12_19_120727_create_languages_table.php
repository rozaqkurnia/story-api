<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Language;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
        });

        Language::create([
            'name' => 'English',
            'slug' => 'english',
        ]);
        Language::create([
            'name' => 'Indonesian',
            'slug' => 'indonesian',
        ]);
        Language::create([
            'name' => 'Italian',
            'slug' => 'italian',
        ]);
        Language::create([
            'name' => 'Japanese',
            'slug' => 'japanese',
        ]);
        Language::create([
            'name' => 'Javanese',
            'slug' => 'javanese',
        ]);
        Language::create([
            'name' => 'Korean',
            'slug' => 'korean',
        ]);
        Language::create([
            'name' => 'Mandarin Chinese',
            'slug' => 'mandarin-chinese',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
