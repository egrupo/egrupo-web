<?php

use Illuminate\Database\Seeder;

class seed_os_type_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('os_types')->insert(
			array(
				array('type' => '1','desc' => 'Admissão'),
				array('type' => '2','desc' => 'Demissão'),
				array('type' => '3','desc' => 'Passagens de divisão'),
				array('type' => '4','desc' => 'Progresso escotista, promessas e compromissos')
			)
		);
    }
}
