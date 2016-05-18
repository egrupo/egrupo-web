<?php

use Illuminate\Database\Seeder;

class seed_especialidades_data_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('data_especialidades')->insert(
			array(
				array('id' => '1' , 'divisao' => '1', 'label' => 'Animação','image_link' => 'images/esp_alc/1.png'),
				array('id' => '2' , 'divisao' => '1', 'label' => 'Artes Plásticas','image_link' => 'images/esp_alc/2.png'),
				array('id' => '3' , 'divisao' => '1', 'label' => 'Atleta','image_link' => 'images/esp_alc/3.png'),
				array('id' => '4' , 'divisao' => '1', 'label' => 'Campista','image_link' => 'images/esp_alc/4.png'),
				array('id' => '5' , 'divisao' => '1', 'label' => 'Comunicação','image_link' => 'images/esp_alc/5.png'),
				array('id' => '6' , 'divisao' => '1', 'label' => 'Conhecimento de Religiões','image_link' => 'images/esp_alc/6.png'),
				array('id' => '7' , 'divisao' => '1', 'label' => 'Conservação da Natureza','image_link' => 'images/esp_alc/7.png'),
				array('id' => '8' , 'divisao' => '1', 'label' => 'Cozinha de Campo','image_link' => 'images/esp_alc/8.png'),
				array('id' => '9' , 'divisao' => '1', 'label' => 'Desportos de Aventura','image_link' => 'images/esp_alc/9.png'),
				array('id' => '10' , 'divisao' => '1', 'label' => 'Desportos Coletivos','image_link' => 'images/esp_alc/10.png'),
				array('id' => '11' , 'divisao' => '1', 'label' => 'Habilidade Manual','image_link' => 'images/esp_alc/11.png'),
				array('id' => '12' , 'divisao' => '1', 'label' => 'Intercultural','image_link' => 'images/esp_alc/12.png'),
				array('id' => '13' , 'divisao' => '1', 'label' => 'Música','image_link' => 'images/esp_alc/13.png'),
				array('id' => '14' , 'divisao' => '1', 'label' => 'Naturalista','image_link' => 'images/esp_alc/14.png'),
				array('id' => '15' , 'divisao' => '1', 'label' => 'Observação','image_link' => 'images/esp_alc/15.png'),
				array('id' => '16' , 'divisao' => '1', 'label' => 'Orientação','image_link' => 'images/esp_alc/16.png'),
				array('id' => '17' , 'divisao' => '1', 'label' => 'Pioneirismo','image_link' => 'images/esp_alc/17.png'),
				array('id' => '18' , 'divisao' => '1', 'label' => 'Primeiros Socorros','image_link' => 'images/esp_alc/18.png'),
				array('id' => '19' , 'divisao' => '1', 'label' => 'Técnica Náutica','image_link' => 'images/esp_alc/19.png'),
				array('id' => '20' , 'divisao' => '2', 'label' => 'Animação','image_link' => 'image/sesp_tes/20.png'),
				array('id' => '21' , 'divisao' => '2', 'label' => 'Artes Plásticas','image_link' => 'images/esp_tes/21.png'),
				array('id' => '22' , 'divisao' => '2', 'label' => 'Atleta','image_link' => 'images/esp_tes/22.png'),
				array('id' => '23' , 'divisao' => '2', 'label' => 'Audiovisuais','image_link' => 'images/esp_tes/23.png'),
				array('id' => '24' , 'divisao' => '2', 'label' => 'Campista','image_link' => 'images/esp_tes/24.png'),
				array('id' => '25' , 'divisao' => '2', 'label' => 'Comunicação','image_link' => 'images/esp_tes/25.png'),
				array('id' => '26' , 'divisao' => '2', 'label' => 'Conhecimento de Religiões','image_link' => 'images/esp_tes/26.png'),
				array('id' => '27' , 'divisao' => '2', 'label' => 'Conhecimento do Escotismo','image_link' => 'images/esp_tes/27.png'),
				array('id' => '28' , 'divisao' => '2', 'label' => 'Conservação da Natureza','image_link' => 'images/esp_tes/28.png'),
				array('id' => '29' , 'divisao' => '2', 'label' => 'Cozinha de Campo','image_link' => 'images/esp_tes/29.png'),
				array('id' => '30' , 'divisao' => '2', 'label' => 'Desportos Aquáticos','image_link' => 'images/esp_tes/30.png'),
				array('id' => '31' , 'divisao' => '2', 'label' => 'Desportos Coletivos','image_link' => 'images/esp_tes/31.png'),
				array('id' => '32' , 'divisao' => '2', 'label' => 'Desportos de Aventura','image_link' => 'images/esp_tes/32.png'),
				array('id' => '33' , 'divisao' => '2', 'label' => 'Exploração','image_link' => 'images/esp_tes/33.png'),
				array('id' => '34' , 'divisao' => '2', 'label' => 'Habilidade Manual','image_link' => 'images/esp_tes/34.png'),
				array('id' => '35' , 'divisao' => '2', 'label' => 'Intercultural','image_link' => 'images/esp_tes/35.png'),
				array('id' => '36' , 'divisao' => '2', 'label' => 'Música','image_link' => 'images/esp_tes/36.png'),
				array('id' => '37' , 'divisao' => '2', 'label' => 'Naturalista','image_link' => 'images/esp_tes/37.png'),
				array('id' => '38' , 'divisao' => '2', 'label' => 'Observação','image_link' => 'images/esp_tes/38.png'),
				array('id' => '39' , 'divisao' => '2', 'label' => 'Orientação','image_link' => 'images/esp_tes/39.png'),
				array('id' => '40' , 'divisao' => '2', 'label' => 'Pioneirismo','image_link' => 'images/esp_tes/40.png'),
				array('id' => '41' , 'divisao' => '2', 'label' => 'Primeiros Socorros','image_link' => 'images/esp_tes/41.png'),
				array('id' => '42' , 'divisao' => '2', 'label' => 'Técnica Náutica','image_link' => 'images/esp_tes/42.png'),
				array('id' => '43' , 'divisao' => '3', 'label' => 'Animação','image_link' => 'images/esp_tex/43.png'),
				array('id' => '44' , 'divisao' => '3', 'label' => 'Artes Plásticas','image_link' => 'images/esp_tex/44.png'),
				array('id' => '45' , 'divisao' => '3', 'label' => 'Atleta','image_link' => 'images/esp_tex/45.png'),
				array('id' => '46' , 'divisao' => '3', 'label' => 'Audiovisuais','image_link' => 'images/esp_tex/46.png'),
				array('id' => '47' , 'divisao' => '3', 'label' => 'Campista','image_link' => 'images/esp_tex/47.png'),
				array('id' => '48' , 'divisao' => '3', 'label' => 'Comunicação','image_link' => 'images/esp_tex/48.png'),
				array('id' => '49' , 'divisao' => '3', 'label' => 'Conhecimento de Religiões','image_link' => 'images/esp_tex/49.png'),
				array('id' => '50' , 'divisao' => '3', 'label' => 'Conhecimento do Escotismo','image_link' => 'images/esp_tex/50.png'),
				array('id' => '51' , 'divisao' => '3', 'label' => 'Conservação da Natureza','image_link' => 'images/esp_tex/51.png'),
				array('id' => '52' , 'divisao' => '3', 'label' => 'Cozinha de Campo','image_link' => 'images/esp_tex/52.png'),
				array('id' => '53' , 'divisao' => '3', 'label' => 'Desportos Aquáticos','image_link' => 'images/esp_tex/53.png'),
				array('id' => '54' , 'divisao' => '3', 'label' => 'Desportos Coletivos','image_link' => 'images/esp_tex/54.png'),
				array('id' => '55' , 'divisao' => '3', 'label' => 'Desportos de Aventura','image_link' => 'images/esp_tex/55.png'),
				array('id' => '56' , 'divisao' => '3', 'label' => 'Exploração','image_link' => 'images/esp_tex/56.png'),
				array('id' => '57' , 'divisao' => '3', 'label' => 'Habilidade Manual','image_link' => 'images/esp_tex/57.png'),
				array('id' => '58' , 'divisao' => '3', 'label' => 'Intercultural','image_link' => 'images/esp_tex/58.png'),
				array('id' => '59' , 'divisao' => '3', 'label' => 'Música','image_link' => 'images/esp_tex/59.png'),
				array('id' => '60' , 'divisao' => '3', 'label' => 'Naturalista','image_link' => 'images/esp_tex/60.png'),
				array('id' => '61' , 'divisao' => '3', 'label' => 'Observação','image_link' => 'images/esp_tex/61.png'),
				array('id' => '62' , 'divisao' => '3', 'label' => 'Orientação','image_link' => 'images/esp_tex/62.png'),
				array('id' => '63' , 'divisao' => '3', 'label' => 'Pioneirismo','image_link' => 'images/esp_tex/63.png'),
				array('id' => '64' , 'divisao' => '3', 'label' => 'Primeiros Socorros','image_link' => 'images/esp_tex/64.png'),
				array('id' => '65' , 'divisao' => '3', 'label' => 'Sobrevivência','image_link' => 'images/esp_tex/65.png'),
				array('id' => '66' , 'divisao' => '3', 'label' => 'Técnica Náutica','image_link' => 'images/esp_tex/66.png'),
				array('id' => '67' , 'divisao' => '4', 'label' => 'Exploração','image_link' => 'images/esp_cla/67.png'),
				array('id' => '68' , 'divisao' => '4', 'label' => 'Internacional','image_link' => 'images/esp_cla/68.png'),
				array('id' => '69' , 'divisao' => '4', 'label' => 'Serviços','image_link' => 'images/esp_cla/69.png'),
				array('id' => '70' , 'divisao' => '4', 'label' => 'Técnica','image_link' => 'images/esp_cla/70.png')
			));
    }
}
