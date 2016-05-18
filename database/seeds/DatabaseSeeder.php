<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(seed_divisoes_table::class);
        $this->call(seed_especialidades_data_table::class);
        $this->call(seed_etapas_data_table::class);
        $this->call(seed_os_type_table::class);
        $this->call(seed_desafios_especialidade_table::class);
        $this->call(seed_admin::class);

        Model::reguard();
    }
}
