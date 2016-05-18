<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscoteirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escoteiros', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('organization_id');
            $table->integer('id_associativo');
            $table->string('nome');
            $table->integer('divisao');
            $table->string('nome_completo');
            $table->string('totem');
            $table->string('patrulha');
            $table->string('cargo');
            $table->string('nivel_escotista');
            $table->date('data_nascimento');
            $table->date('entrada_grupo');
            $table->string('email');
            $table->string('telemovel');
            $table->string('bi');
            $table->string('nif');
            $table->string('nome_ee_1');
            $table->string('nome_ee_2');
            $table->string('telem_ee_1');
            $table->string('telem_ee_2');
            $table->string('email_ee_1');
            $table->string('email_ee_2');
            $table->boolean('avatar_url');
            $table->date('compromisso_honra');
            $table->boolean('autoriza_imagem');
            $table->boolean('ficha_inscricao');
            $table->text('morada');
            $table->text('descricao');
            $table->text('notas');
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
        Schema::drop('escoteiros');
    }
}
