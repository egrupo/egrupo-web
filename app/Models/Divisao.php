<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisao extends Model {
    
    public static $ALCATEIA = 1;
	public static $TES = 2;
	public static $TEX = 3;
	public static $CLA = 4;
	public static $CHEFIA = 5;

	public static $GRUPO = 10;

	protected $table = 'divisoes';
	public $timestamps = false;

	public static function getId($label){
		
		if(strcmp($label,'Grupo') == 0)
			return 10;
		
		return Divisao::where('label','=',$label)->pluck('id');
	}

	public static function getLabel($id){
		if($id == Divisao::$GRUPO)
			return 'Grupo';

		return Divisao::where('id','=',$id)->pluck('label');
	}

	public static function getName($id){
		return Divisao::where('id',$id)->pluck('value');
	}
}
