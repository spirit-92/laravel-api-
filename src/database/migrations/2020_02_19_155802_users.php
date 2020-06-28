<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_user', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('gender');
            $table->string('ip_address');
            $table->integer('total_clicks')->nullable();
            $table->integer('page_views')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        Schema::create('totalClicks', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('clicks_id')->index();
            $table->integer('clicks');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        Schema::create('pageViews', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('page_id')->index();
            $table->integer('views');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::create('token', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id')->index();
            $table->string('token', 64);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        Schema::create('base_news', function (Blueprint $table) {
            $table->integer('id_news')->autoIncrement();
            $table->string('title', 200)->nullable()->unique();
            $table->string('img')->nullable();
            $table->string('url')->nullable();
            $table->string('publish_news')->nullable();
            $table->string('author')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        Schema::create('user_news', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id')->index();
            $table->integer('news_id')->index();
        });
        Schema::create('user_music', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id')->index();
            $table->integer('music_id')->index();
        });
        Schema::create('user_philosophy', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id')->index();
            $table->boolean('update');
            $table->integer('philosophy_id')->index();
        });
        Schema::create('status', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('status', 10);
        });
        Schema::create('users', function (Blueprint $table) {
            $table->integer('user_id')->autoIncrement();
            $table->string('user_name', 50);
            $table->string('password', 1000);
            $table->string('email', 30)->unique();
            $table->string('avatar', 500)->nullable();
            $table->string('avatarSocial', 500)->nullable();
            $table->integer('status_id')->index()->default(2);;
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        Schema::create('all_philosophy', function (Blueprint $table) {
            $table->integer('philosophy_id')->autoIncrement();
            $table->string('title', 600)->unique();
            $table->text('body');
            $table->string('url', 600)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        Schema::create('all_music', function (Blueprint $table) {
            $table->integer('music_id')->autoIncrement();
            $table->string('url', 600);
            $table->string('title', 600)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });


        Schema::table('totalClicks', function ($table) {
            $table->foreign('clicks_id')->references('id')->on('statistic_user');
        });
        Schema::table('pageViews', function ($table) {
            $table->foreign('page_id')->references('id')->on('statistic_user');
        });


        Schema::table('user_music', function ($table) {
            $table->foreign('user_id')->references('user_id')->on('users');
        });


        Schema::table('user_music', function ($table) {
            $table->foreign('music_id')->references('music_id')->on('all_music');
        });
        Schema::table('user_philosophy', function ($table) {
            $table->foreign('user_id')->references('user_id')->on('users');
        });
        Schema::table('user_philosophy', function ($table) {
            $table->foreign('philosophy_id')->references('philosophy_id')->on('all_philosophy');
        });
        Schema::table('user_news', function ($table) {
            $table->foreign('user_id')->references('user_id')->on('users');
        });
        Schema::table('user_news', function ($table) {
            $table->foreign('news_id')->references('id_news')->on('base_news');
        });

        Schema::table('token', function ($table) {
            $table->foreign('user_id')->references('user_id')->on('users');
        });
        Schema::table('users', function ($table) {
            $table->foreign('status_id')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
