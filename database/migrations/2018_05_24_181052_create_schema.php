<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('timestamp')->useCurrent();
        });
        
        Schema::create('translated_article', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id');
            $table->text('language');
            $table->text('summary');
            $table->text('text');
            $table->boolean('published');
            $table->foreign('article_id')->references('id')->on('article');
        });
        
        Schema::create('trip', function (Blueprint $table) {
            $table->increments('id');
        });
        
        Schema::create('translated_trip', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trip_id');
            $table->text('language');
            $table->text('name');
            $table->text('url_name');
            $table->foreign('trip_id')->references('id')->on('trip');
        });

        Schema::create('trip_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trip_id');
            $table->integer('user_id');
            $table->foreign('trip_id')->references('id')->on('trip');
        });
        
        Schema::create('city_visit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->nullable();
            $table->integer('city_id');
            $table->integer('trip_id');
            $table->text('visit_start_year');
            $table->text('visit_start_month')->nullable();
            $table->text('visit_start_day')->nullable();
            $table->text('visit_end_year');
            $table->text('visit_end_month')->nullable();
            $table->text('visit_end_day')->nullable();
            $table->foreign('article_id')->references('id')->on('article');
            $table->foreign('trip_id')->references('id')->on('trip');
        });

        Schema::create('city_visit_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_visit_id');
            $table->integer('user_id');
            $table->foreign('city_visit_id')->references('id')->on('city_visit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('translated_trip');
        Schema::drop('trip_user');
        Schema::drop('city_visit_user');
        Schema::drop('city_visit');
        Schema::drop('trip');
        Schema::drop('translated_article');
        Schema::drop('article');
    }
}
