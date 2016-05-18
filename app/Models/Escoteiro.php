<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Etapa;
use App\Models\Especialidade;
use App\Models\ProvaEtapa;
use App\Models\ProvaEspecialidade;
use App\Models\Presenca;

use Validator;
use DB;
use Auth;

class Escoteiro extends Model {

	public $timestamps = true;
	protected $fillable = [
		'id_associativo','divisao','nome','id','nome_completo','telemovel','email','nif','bi',
		'patrulha','cargo','nivel_escotista','data_nascimento','totem','avatar_url',
		'descricao','morada','entrada_grupo','notas','nome_ee_1','nome_ee_2','telem_ee_1',
		'telem_ee_2','email_ee_1','email_ee_2','autoriza_imagem','ficha_inscricao','compromisso_honra','organization_id'
		];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'escoteiros';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public static $rules = [
		'divisao' => 'required',
		'nome' => 'required',
		'id_associativo' => 'required|integer'
	];

	public $errors;

	public function isValid(){
		$validation = Validator::make($this->attributes,static::$rules);

		if($validation->passes())
			return true;

		$this->messages = $validation->messages();
		return false;
	}

	public function organization(){
        return $this->belongsTo('App\Models\Organization','organization_id');
    }

    public function concludedEtapa($etapa,$divisao){
		$concluded = Etapa::where('divisao',$divisao)->where('etapa',$etapa)->where('escoteiro_id',$this->id)->pluck('concluded_at');
		return $concluded;
	}

	public function concludedEspecialidade($id){
		return Especialidade::where('especialidade','=',$id)
							->where('escoteiro_id','=',$this->id)
							->pluck('concluded_at');
	}

	public function concludedProva($etapa,$divisao,$prova){
		$concluded = ProvaEtapa::where('divisao','=',$divisao)
								->where('etapa','=',$etapa)
								->where('escoteiro_id','=',$this->id)
								->where('prova','=',$prova)
								->pluck('concluded_at');
		return $concluded;	
	}

	public function concludedProvaEspecialidade($esp,$prova){
		$concluded = ProvaEspecialidade::where('especialidade','=',$esp)
								->where('escoteiro_id','=',$this->id)
								->where('prova','=',$prova)
								->pluck('concluded_at');
		return $concluded;	
	}

	public function getAssiduidade(){

		// $total = Presenca::where('user_id',$this->id)->count();
		// $total = Atividade::where('divisao','=',$this->divisao)
		// 					->where('performed_at','<=',new DateTime('today'))
		// 					->count();

		$total = DB::table('atividades')
						->join('presencas','atividades.id','=','presencas.atividade_id')
						->where('atividades.performed_at','<=',new \DateTime('today'))
						->where('presencas.user_id',$this->id)
						->where('atividades.ano',Atividade::getCurrentYear())
						->count();

		$presencas = DB::table('atividades')
						->join('presencas','atividades.id','=','presencas.atividade_id')
						->where('atividades.performed_at','<=',new \DateTime('today'))
						->where('presencas.user_id',$this->id)
						->where('atividades.ano',Atividade::getCurrentYear())
						->where('presencas.tipo',Presenca::$PRESENTE)
						->count();

		if($total == 0){
			return '0%';
		}

		return number_format($presencas/$total*100) .'%';
	}

	public function getCurrentEtapa(){
		$etapa = Etapa::where('divisao','=',$this->divisao)
						->where('escoteiro_id','=',$this->id)
						->orderBy('etapa','DESC')
						->first();

		if($etapa){
			return $etapa->etapa;
		} else {
			return 0;
		}

	}

	public function getCurrentPercentage($etapa){

		$ntotal = Etapa::getNProvas($etapa,$this->divisao);

		$nassinadas = ProvaEtapa::where('escoteiro_id',$this->id)
									->where('etapa',$etapa)
									->where('divisao',$this->divisao)
									->count();

		if($ntotal == 0)
			return 'na';

		return round($nassinadas/$ntotal*100).'%';

	}

    public function getEspecialidades($divisao){

		$especialidades = DB::table('especialidades')
				->join('data_especialidades','especialidades.especialidade','=','data_especialidades.id')
				->where('data_especialidades.divisao','=',$divisao)
				->where('especialidades.escoteiro_id','=',$this->id)
				->get();

		return $especialidades;
	}

	public function getPresencas($trimestre,$ano){
		$presencas = DB::table('atividades')
							->join('presencas','atividades.id','=','presencas.atividade_id')
							->where('presencas.user_id','=',$this->id)
							->where('atividades.ano','=',$ano)
							->where('atividades.trimestre','=',$trimestre)
							->get();
							
		return $presencas;
	}

	public function scopeGrupo($query){
		return $query->where('organization_id',Auth::user()->organization_id);
	}

	/* Static shizzle */
	public static function getEscoteirosList($divisao){
		return Escoteiro::grupo()->where('divisao','=',$divisao)->lists('nome','id');
	}

	public static function getEscoteiros($divisao){
		return Escoteiro::grupo()->where('divisao','=',$divisao)->get();
	}

	public static function getAll(){
		return Escoteiro::grupo()->whereIn('divisao',array(Divisao::$ALCATEIA,Divisao::$TES,Divisao::$TEX,Divisao::$CLA,Divisao::$CHEFIA))
				->orderBy('divisao')
				->get();
	}

	public static function getRealId($escoteiro_id){
		return Escoteiro::grupo()->where('id_associativo',$escoteiro_id)->pluck('id');
	}

	public static function getEfetivoOS(){
		$scouts = DB::table('escoteiros')
			->join('divisoes','escoteiros.divisao','=','divisoes.id')
			->where('organization_id',Auth::user()->organization_id)
			->where(function($query){
					$query->where('escoteiros.divisao',Divisao::$ALCATEIA)
							->orWhere('escoteiros.divisao',Divisao::$TES)
							->orWhere('escoteiros.divisao',Divisao::$TEX)
							->orWhere('escoteiros.divisao',Divisao::$CLA)
							->orWhere('escoteiros.divisao',Divisao::$CHEFIA);
				})
			->orderBy('escoteiros.divisao','DESC')
			->orderBy('escoteiros.patrulha','DESC')
			->select('divisoes.label as divisao','escoteiros.patrulha','escoteiros.cargo','escoteiros.nivel_escotista','escoteiros.nome','escoteiros.totem','escoteiros.id_associativo')
			->get();
		
		return $scouts;
	}

}
