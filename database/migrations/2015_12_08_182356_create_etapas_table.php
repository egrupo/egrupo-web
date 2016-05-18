<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtapasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etapas', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('etapa');
            $table->integer('divisao');
            $table->integer('escoteiro_id');
            $table->date('concluded_at');
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
        Schema::drop('etapas');
    }
}
