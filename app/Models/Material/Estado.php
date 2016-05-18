<?php

namespace App\Models\Material;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    public static $NADA = 0;
    public static $COMPLETO = 1;
	public static $INCOMPLETO = 2;
	public static $DANIFICADO = 3;

	public static $estados = array(
		'',
		'completo',
		'incompleto',
		'danificado'
		);

	public static $classes = array(
		'',
		'success',
		'warning',
		'danger'
		);

	public static function getClass($estado){
		return static::$classes[$estado];
	}

	public static function getEstadosArray(){
		return array(
			'0' => 'Estado',
			'1' => 'Completo',
			'2' => 'Incompleto',
			'3' => 'Danificado',
			);
	}
}
