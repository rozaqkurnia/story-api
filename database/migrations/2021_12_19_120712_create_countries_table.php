<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Country;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
        });

        Country::create([
            'name' => 'Australia',
            'slug' => 'australia',
        ]);
        Country::create([
            'name' => 'Canada',
            'slug' => 'canada',
        ]);
        Country::create([
            'name' => 'India',
            'slug' => 'india',
        ]);
        Country::create([
            'name' => 'Indonesia',
            'slug' => 'indonesia',
        ]);
        Country::create([
            'name' => 'Italy',
            'slug' => 'italy'
        ]);
        Country::create([
            'name' => 'Japan',
            'slug' => 'japan',
        ]);
        Country::create([
            'name' => 'Netherland',
            'slug' => 'netherland',
        ]);
        Country::create([
            'name' => 'South Korea',
            'slug' => 'south-korea'
        ]);
        Country::create([
            'name' => 'United Kingdom',
            'slug' => 'united-kingdom',
        ]);
        Country::create([
            'name' => 'United States',
            'slug' => 'united-states',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
