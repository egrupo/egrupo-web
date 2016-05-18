<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvasEtapaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provas_etapa', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('prova');
            $table->integer('escoteiro_id');
            $table->integer('etapa');
            $table->integer('divisao');
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
        Schema::drop('provas_etapa');
    }
}
