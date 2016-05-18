<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividades', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('organization_id');
            $table->integer('divisao');
            $table->string('nome');
            $table->date('performed_at');
            $table->string('local');
            $table->string('duracao');
            $table->integer('trimestre');
            $table->string('ano');
            $table->text('descricao');
            $table->text('infos');
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
        Schema::drop('atividades');
    }
}
