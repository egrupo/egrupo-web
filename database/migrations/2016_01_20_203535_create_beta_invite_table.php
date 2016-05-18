<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBetaInviteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invites',function(Blueprint $table){
            $table->increments('id');
            $table->string('code');
            $table->string('email');
            $table->string('nome');
            $table->integer('npessoas');
            $table->integer('numero_grupo');
            $table->boolean('can_signup')->default(false);
            $table->timestamp('claimed_at')->nullable();
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
        Schema::drop('invites');
    }
}
