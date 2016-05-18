<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInfoColumnsOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations',function($table) {
            $table->string('email')->after('slug');
            $table->string('telemovel')->after('email');
            $table->text('morada')->after('telemovel');
            $table->string('localidade')->after('morada');
            $table->string('regiao')->after('morada');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations',function($table){
            $table->dropColumn('email');
            $table->dropColumn('telemovel');
            $table->dropColumn('morada');
            $table->dropColumn('regiao');
            $table->dropColumn('localidade');
        });
    }
}
