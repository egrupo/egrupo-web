<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesafiosEspecialidadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desafios_especialidade', function(Blueprint $table)
        {
            $table->integer('id');
            $table->integer('especialidade_id');
            $table->integer('divisao');
            $table->text('titulo');
            $table->text('descricao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('desafios_especialidade'); 
    }
}
