<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens_servico', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('type');
            $table->date('data');
            $table->integer('divisao');
            $table->integer('escoteiro_id');
            $table->integer('organization_id');
            $table->string('label');
            $table->string('ano');
            $table->integer('trimestre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ordens_servico');
    }
}
