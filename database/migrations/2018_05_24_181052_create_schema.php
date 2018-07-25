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
        Schema::create('language', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('code');
        });
        
        DB::table('language')->insert([ 'name' => 'suomi',   'code' => 'fi' ]);
        DB::table('language')->insert([ 'name' => 'english', 'code' => 'en' ]);
        
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('timestamp')->useCurrent();
        });
        
        Schema::create('translated_article', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id');
            $table->integer('language_id');
            $table->text('summary');
            $table->text('text');
            $table->boolean('published');
            $table->foreign('article_id')->references('id')->on('article');
            $table->foreign('language_id')->references('id')->on('language');
        });
        
        Schema::create('article_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id');
            $table->integer('user_id');
            $table->foreign('article_id')->references('id')->on('article');
        });

        Schema::create('country', function (Blueprint $table) {
            $table->increments('id');
        });
        
        Schema::create('translated_country', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id');
            $table->integer('language_id');
            $table->text('name');
            $table->text('url_name');
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
            $table->text('url_name');
            $table->foreign('city_id')->references('id')->on('city');
            $table->foreign('language_id')->references('id')->on('language');
        });
        
        Schema::create('trip', function (Blueprint $table) {
            $table->increments('id');
        });
        
        Schema::create('translated_trip', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id');
            $table->integer('trip_id');
            $table->text('name');
            $table->text('url_name');
            $table->foreign('language_id')->references('id')->on('language');
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
            $table->text('visit_start')->nullable();
            $table->text('visit_end')->nullable();
            $table->foreign('article_id')->references('id')->on('article');
            $table->foreign('city_id')->references('id')->on('city');
            $table->foreign('trip_id')->references('id')->on('trip');
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
        Schema::drop('city_visit');
        Schema::drop('trip');
        Schema::drop('translated_city');
        Schema::drop('city');
        Schema::drop('translated_country');
        Schema::drop('country');
        Schema::drop('article_user');
        Schema::drop('translated_article');
        Schema::drop('article');
        Schema::drop('language');
    }
}
