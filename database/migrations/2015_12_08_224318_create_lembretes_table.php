<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLembretesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembretes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('organization_id');
            $table->date('remindme_at');
            $table->text('label');
            $table->integer('user_id');
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
        Schema::drop('lembretes');
    }
}
