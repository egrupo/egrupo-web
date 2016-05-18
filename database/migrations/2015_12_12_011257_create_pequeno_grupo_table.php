<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePequenoGrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pequeno_grupo', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('organization_id');
            $table->string('nome');
            $table->integer('divisao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pequeno_grupo');
    }
}
