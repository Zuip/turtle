<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryAndCityTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country', function (Blueprint $table) {
            $table->increments('id');
        });
        
        Schema::create('translated_country', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id');
            $table->integer('language_id');
            $table->text('name');
            $table->foreign('country_id')->references('id')->on('country');
            $table->foreign('language_id')->references('id')->on('language');
        });
        
        Schema::create('city', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id');
            $table->foreign('country_id')->references('id')->on('country');
        });
        
        Schema::create('translated_city', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id');
            $table->integer('language_id');
            $table->text('name');
            $table->foreign('city_id')->references('id')->on('city');
            $table->foreign('language_id')->references('id')->on('language');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::drop('translated_city');
        // Schema::drop('city');
        // Schema::drop('translated_country');
        // Schema::drop('country');
    }
}
