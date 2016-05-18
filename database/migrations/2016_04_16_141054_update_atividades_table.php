<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atividades',function($table) {
            $table->integer('noites_campo')->default(0)->after('duracao');
            $table->text('programa')->after('infos');
            $table->text('objetivos')->after('programa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atividades',function($table){
            $table->dropColumn('programa');
            $table->dropColumn('objetivos');
            $table->dropColumn('noites_campo');
        });
    }
}
