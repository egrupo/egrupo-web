<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistoAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registo_atividades', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('escoteiro_id');
            $table->integer('organization_id');
            $table->integer('atividade_id');
            $table->text('descricao');
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
        Schema::drop('registo_atividades');
    }
}
