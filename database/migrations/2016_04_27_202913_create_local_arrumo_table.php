<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalArrumoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_local_arrumo', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('organization_id');
            $table->integer('divisao');
            $table->string('nome');
            $table->timestamp('last_update_at')->useCurrent();
            $table->integer('user_id');
            $table->integer('display_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('material_local_arrumo');
    }
}
