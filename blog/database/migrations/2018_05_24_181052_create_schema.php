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
        
        Schema::create('user_account', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('password');
            $table->timestamp('registered')->useCurrent();
            $table->integer('login_attempts')->default(0);
        });
        
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->integer('menu_weight');
            $table->boolean('removed')->default(false);
            $table->foreign('parent_id')->references('id')->on('category');
        });
        
        Schema::create('translated_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('language_id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->text('url_name');
            $table->boolean('published');
            $table->foreign('category_id')->references('id')->on('category');
            $table->foreign('language_id')->references('id')->on('language');
        });
        
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->timestamp('timestamp')->useCurrent();
            $table->foreign('category_id')->references('id')->on('category');
        });
        
        Schema::create('translated_article', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id');
            $table->integer('language_id');
            $table->text('topic');
            $table->text('summary');
            $table->text('url_name');
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
            $table->foreign('user_id')->references('id')->on('user_account');
        });

        Schema::create('visited_place', function (Blueprint $table) {
            $table->increments('id');
            $table->text('lat');
            $table->text('lng');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('visited_place');
        Schema::drop('article_user');
        Schema::drop('translated_article');
        Schema::drop('article');
        Schema::drop('translated_category');
        Schema::drop('category');
        Schema::drop('user_account');
        Schema::drop('language');
    }
}
