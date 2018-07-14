<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUserAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('article_user');

        Schema::dropIfExists('user_account');

        Schema::create('article_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id');
            $table->integer('user_id');
            $table->foreign('article_id')->references('id')->on('article');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_user');

        Schema::create('user_account', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('password');
            $table->timestamp('registered')->useCurrent();
            $table->integer('login_attempts')->default(0);
        });

        Schema::create('article_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id');
            $table->integer('user_id');
            $table->foreign('article_id')->references('id')->on('article');
            $table->foreign('user_id')->references('id')->on('user_account');
        });
    }
}
