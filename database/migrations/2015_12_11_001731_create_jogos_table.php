<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJogosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recursos_jogos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('organization_id');
            $table->string('nome');
            $table->text('descricao');
            $table->integer('n_participantes');
            $table->integer('duracao');
            $table->string('divisoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recursos_jogos');
    }
}
