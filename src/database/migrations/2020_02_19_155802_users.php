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
        Schema::create('token', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id')->index();
            $table->string('token',64);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        Schema::create('post', function (Blueprint $table) {
            $table->integer('post_id')->autoIncrement();
            $table->integer('user_id')->index();
            $table->text('body');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        Schema::create('status', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('status',10);
        });

        Schema::create('users', function (Blueprint $table) {
            $table->integer('user_id')->autoIncrement();
            $table->string('user_name',15)->unique();
            $table->string('password',60);
            $table->string('email',30)->unique();
            $table->string('avatar',500)->nullable();
            $table->integer('status_id')->index()->default(2);;
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('token', function($table) {
            $table->foreign('user_id')->references('user_id')->on('users');
        });
        Schema::table('users', function($table) {
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
