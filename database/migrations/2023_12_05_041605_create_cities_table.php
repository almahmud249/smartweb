<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->string('city');
            $table->string('city_ascii');
            $table->string('state_id');
            $table->string('state_name');
            $table->string('county_fips');
            $table->string('county_name');
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->bigInteger('population');
            $table->integer('density');
            $table->string('source');
            $table->boolean('military')->default(1);
            $table->boolean('incorporated')->default(1);
            $table->string('timezone');
            $table->integer('ranking');
            $table->string('zips');
            $table->integer('id');

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
        Schema::dropIfExists('cities');
    }
}
