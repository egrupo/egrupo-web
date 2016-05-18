<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Especialidade extends Model {
    

	public $timestamps = true;
	protected $fillable = [
		'especialidade','escoteiro_id','concluded_at','created_at','updated_at'
		];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'especialidades';

	public static function getEspecialidadesArray($divisao){
		$especialidades = DB::table('data_especialidades')->where('divisao','=',$divisao)->get();

		$res = array('' => 'especialidade');

		foreach($especialidades as $e){
			$res = array_merge($res, array($e->id => $e->label));
		}

		return $res;
	}

	public static function getDesafiosEspecialidade($id){
		$esps = DB::table('desafios_especialidade')
					->where('especialidade_id','=',$id)
					->get();

		return $esps;
	}

	public static function getNDesafiosEspecialidade($id){
		return DB::table('desafios_especialidade')
					->where('especialidade_id','=',$id)
					->count();
	}

	public static function getEspecialidades($divisao){
		$esps = DB::table('data_especialidades')->where('divisao','=',$divisao)->get();
		return $esps;
	}

	public static function getCountEspecialidades($divisao){
		return DB::table('data_especialidades')->where('divisao','=',$divisao)->count();
	}

}
