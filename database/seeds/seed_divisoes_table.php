<?php

use Illuminate\Database\Seeder;

class seed_divisoes_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('divisoes')->insert(
            array(
                array('id' => '1' , 'value' => 'Alcateia', 'label' => 'Alcateia'),
                array('id' => '2' , 'value' => 'Tribo de Escoteiros', 'label' => 'TEs'),
                array('id' => '3' , 'value' => 'Tribo de Exploradores', 'label' => 'TEx'),
                array('id' => '4' , 'value' => 'Clã', 'label' => 'Cla'),
                array('id' => '5' , 'value' => 'Chefia', 'label' => 'Chefia')
            ));
    }
}
