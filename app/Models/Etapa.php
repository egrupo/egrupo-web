<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;
use DB;
use Auth;

class Etapa extends Model {
	
	public $timestamps = true;
	protected $fillable = [
		'etapa','divisao','escoteiro_id','concluded_at','created_at','updated_at'
		];

    protected $table = 'etapas';

    public static function getEtapaCount($divisao,$etapa){

		$sub = DB::table('etapas')
				->join('escoteiros','escoteiros.id','=','etapas.escoteiro_id')
				->select(DB::raw('escoteiros.nome,escoteiro_id,max(etapa) as etapa,etapas.divisao'))
				->where('escoteiros.divisao',$divisao)
				->where('etapas.divisao',$divisao)
				->where('escoteiros.organization_id',Auth::user()->organization_id)
				->groupBy('escoteiro_id')->get();

		$count = 0;
		foreach($sub as $e){
			if($e->etapa == $etapa)
				$count++;
		}

		return $count;
	}

    public static function getNProvas($etapa,$divisao){

		return DB::table('desafios')
					->where('divisao',$divisao)
					->where('etapa',$etapa)
					->count();

	}

	public static function getLabel($etapa,$divisao){
		switch ($etapa) {
			case '1':
				if($divisao == User::$ALCATEIA)
					return '1ª Estrela';
				else
					return '1ª Etapa';
			case '2':
				if($divisao == User::$ALCATEIA)
					return '2ª Estrela';
				else
					return '2ª Etapa';
			case '3':
				if($divisao == User::$ALCATEIA)
					return 'Lobito Alerta';
				else
					return '3ª Etapa';
		}
	}
}
