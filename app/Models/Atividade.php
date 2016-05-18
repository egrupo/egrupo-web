<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Divisao;
use App\Models\Presenca;

use Auth;
use DB;
use Validator;
use Carbon;

class Atividade extends Model
{
    public $timestamps = true;
	protected $fillable = [
			'nome','organization_id','performed_at','divisao','local','descricao','infos','duracao',
			'created_at','updated_at','trimestre','ano','programa','objetivos','noites_campo'
		];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'atividades';

	public $messages = array('performed_at.required' => 'Esta atividade tem de ter uma data',
                'nome.required' => 'Esta atividade tem de ter um nome',
                'divisao.required' => 'Eta atividade tem de estar associada a uma divisão',
        );

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public static $rules = [
		'divisao' => 'required',
		'nome' => 'required',
		'performed_at' => 'required'
	];

	public $errors;

	public function isValid(){
		$validation = Validator::make($this->attributes,static::$rules,$this->messages);

		if($validation->passes())
			return true;

		$this->messages = $validation->messages();
			return false;

	}

	// public function presencas(){
	// 	return $this->hasMany('App\Models\Presencas','atividade_id');
	// }

	public function scopeGrupo($query){
		return $query->where('organization_id',Auth::user()->organization_id);
	}

	public function hasPresencas(){
		return Presenca::where('atividade_id','=',$this->id)->count() > 0;
	}

	public function getNumPresencas(){
		return Presenca::where('atividade_id','=',$this->id)->where('tipo','=',Presenca::$PRESENTE)->count();
	}

	public function getTotalPresencas(){
		return Presenca::where('atividade_id','=',$this->id)->where('tipo','=',Presenca::$PRESENTE)->count();
	}

	public static function getAtividades($label,$ano){
		$id = Divisao::where('label',$label)->pluck('id');
		
		return Atividade::grupo()
				->where(function($query) use ($id){
					$query->where('divisao',$id)
							->orWhere('divisao',Divisao::$GRUPO);
				})
				->where('ano','=',$ano)
				->orderBy('performed_at','DESC')
				->get();
	}

	//Chamada para o calendário dos escoteiros
	public static function getAtividadesTrimestre($divisao,$trimestre,$ano){
		return Atividade::grupo()
							->where(function($query) use ($divisao){
								$query->where('divisao',$divisao)
									->orWhere('divisao',Divisao::$GRUPO);
							})
							->where('trimestre',$trimestre)
							->where('ano',$ano)
							->orderBy('performed_at')
							->get();
	}

	public static function getCurrentTrimestre(){
		$month = date('n',strtotime('now'));

		$trimestre = 0;

	 	if($month > 0 && $month <= 3){
	 		$trimestre = 2;
	 	} else if($month > 3 && $month <= 8){
	 		$trimestre = 3;
	 	} else {
	 		$trimestre = 1;	
	 	}

	 	return $trimestre;
	}

	public static function getCurrentYear(){
		$month = date('n');
	 	$year = date('Y');

		$ano = '';

	 	if($month > 0 && $month <= 8){
	 		$ano = ($year-1).'-'.$year;
	 	} else {
	 		$ano = $year.'-'.($year+1);
	 	}

	 	return $ano;
	}

	public static function getYears(){
		return DB::table('atividades')
				->where('organization_id',Auth::user()->organization_id)
				->groupBy('atividades.ano')
				->select('atividades.ano')
				->orderBy('atividades.ano','DESC')
				->get();
	}

	public static function getYearsArray(){
		$anos = DB::table('atividades')
						->groupBy('atividades.ano')
						->select('atividades.ano')
						->orderBy('atividades.ano','DESC')
						->get();

		$res = array();

		foreach($anos as $a){
			$res = array_merge($res, array($a->ano => $a->ano));
		}

		return $res;
	}

	// public static function getLastAtividades(){
	// 	//last 10
	// 	return DB::table('atividades')
	// 				->where('performed_at','<=',date('Y-m-d'))
	// 				->groupBy('performed_at')
	// 				->orderBy('performed_at','DESC')
	// 				->take(10)
	// 				->lists('performed_at');
	// }

	// public static function getLastAssiduidade($divisao){

	// 	$datas = Atividade::getLastAtividades();

	// 	$atividades = Atividade::whereIn('performed_at', $datas)
	// 				->get();

	// 	$assid = [];

	// 	foreach($datas as $data){

	// 		$presentes = 0;
	// 		$total = 0;

	// 		foreach ($atividades as $ativ) {
			

	// 			if ($ativ->performed_at == $data) {
	// 				$presentes += DB::table('presencas')
	// 					->join('escoteiros','escoteiros.id','=','presencas.user_id')
	// 					->where('escoteiros.divisao',$divisao)
	// 					->where('presencas.atividade_id',$ativ->id)
	// 					->where('presencas.tipo',Presenca::$PRESENTE)->count();
	// 				$total += Presenca::
	// 						join('escoteiros','escoteiros.id','=','presencas.user_id')
	// 						->where('escoteiros.divisao',$divisao)
	// 						->where('atividade_id',$ativ->id)->count();

	// 			}
	
	// 		}

	// 		if($total == 0){
	// 			$assid[] = 0;
	// 		} else {
	// 			$assid[] = round(($presentes/$total)*100);	
	// 		}
			
	// 	}

	// 	return $assid;
	// }

	public function getLOL(){
		setlocale(LC_TIME, 'pt_PT'); 
		$c = Carbon\Carbon::parse($this->performed_at);
		return $c->formatLocalized('%e de %B');
	}

}
