<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvasEspecialidadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provas_especialidade', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('prova');
            $table->integer('escoteiro_id');
            $table->integer('especialidade');
            $table->date('concluded_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('provas_especialidade');
    }
}
