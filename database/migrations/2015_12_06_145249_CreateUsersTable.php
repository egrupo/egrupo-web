<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('escoteiro_id')->nullable();
            $table->integer('organization_id')->nullable()->index();
            $table->string('user',50);
            $table->string('email', 140)->unique()->index();
            $table->string('password', 140)->index();
            $table->string('remember_token', 100)->index()->nullable();
            $table->string('access_token')->index()->nullable();
            $table->string('name', 255)->nullable();
            $table->integer('divisao')->default(5)->nullable();
            $table->integer('level')->default(2)->nullable();
            $table->string('last_login_at');
            $table->boolean('admin')->default(false)->nullable();
            $table->boolean('active')->default(false)->index()->nullable();
            $table->integer('user_type')->default(1);
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
        Schema::drop('users');
    }
}
