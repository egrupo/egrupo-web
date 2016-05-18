<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Atividade;
use DB;
use Validator;
use Auth;
use Log;
use Storage;
use File;

class OS extends Model
{

	public static $meses = ['','Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
	public static $mesesDim = ['','JAN','FEV','MAR','ABR','MAI','JUN','JUL','AGO','SET','OUT','NOV','DEZ'];

    public $timestamps = false;
	protected $fillable = [
			'data','escoteiro_id','label','divisao','ano','trimestre','type','organization_id'
		];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ordens_servico';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public static $rules = [
		'data' => 'required',
		'label' => 'required',
		'escoteiro_id' => 'required|integer',
		'divisao' => 'required'
	];

    public function isActivityValid(){
		if($this->escoteiro_id == 0){
			if(!Atividade::where('performed_at',$this->data)
						->where('divisao',$this->divisao)
						->where('organization_id',Auth::user()->organization_id)
						->exists()){
				return false;
			}
		}
		
		return true;
	}

	public function organization(){
        return $this->belongsTo('App\Models\Organization','organization_id');
    }

	public function isValid(){
		$validation = Validator::make($this->attributes,static::$rules);

		if($validation->passes())
			return true;

		$this->messages = $validation->messages();
		return false;
	}

	public static function getYears(){
		return DB::table('ordens_servico')
						->groupBy('ordens_servico.ano')
						->select('ordens_servico.ano')
						->orderBy('ordens_servico.ano','DESC')
						->get();
	}

	public static function listOS($divisao,$ano = null){

		if($ano == null)
			$ano = Atividade::getCurrentYear();

		Log::info('Ano é '.$ano);

		$escoteiros = DB::table('ordens_servico')->where('escoteiro_id','<>',0);

		$escoteiros->join('escoteiros', 'ordens_servico.escoteiro_id','=','escoteiros.id')
					->where('ordens_servico.divisao','=',$divisao)
					->where('ordens_servico.organization_id',Auth::user()->organization_id)
					->where('ordens_servico.ano','=',$ano)
					->select('ordens_servico.id','ordens_servico.label','ordens_servico.data','escoteiros.nome','escoteiros.id as escoteiro_id','escoteiros.id as type_id');

		$atividades = DB::table('ordens_servico')->where('escoteiro_id',0);

		$atividades->join('atividades', 'ordens_servico.data','=','atividades.performed_at')
				->where('atividades.divisao',$divisao)
				->where('atividades.organization_id',Auth::user()->organization_id)
				->where('ordens_servico.divisao','=',$divisao)
				->where('ordens_servico.ano','=',$ano)
				->select(DB::raw('ordens_servico.id,ordens_servico.label,ordens_servico.data,atividades.nome,atividades.id as escoteiro_id,COALESCE(0) as type_id'));
					// 'ordens_servico.id','ordens_servico.label','ordens_servico.data','atividades.nome','atividades.id as escoteiro_id','COALESCE(escoteiros.id,0) as type_id');

		return $escoteiros->union($atividades)->get();
	}

	public static function getOSFilesListing(){
		$location = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix().mySlug().'/os/';

		$files = [];
		$filesInFolder = File::files($location);

		foreach($filesInFolder as $path){
		    $files[] = pathinfo($path);
		}

		return $files;
	}

	public static function getAdmissoes($ano,$trimestre){
		return DB::table('ordens_servico')->join('escoteiros','ordens_servico.escoteiro_id','=','escoteiros.id')
			->where('ordens_servico.type',1)
			->where('trimestre',$trimestre)
			->where('ano',$ano)
			->orderBy('ordens_servico.divisao')
			->select(DB::raw('ordens_servico.label,ordens_servico.data,escoteiros.nome'))
			->get();
	}

	public static function getDemissoes($ano,$trimestre){
		return DB::table('ordens_servico')->join('escoteiros','ordens_servico.escoteiro_id','=','escoteiros.id')
			->where('ordens_servico.type',2)
			->where('trimestre',$trimestre)
			->where('ano',$ano)
			->orderBy('ordens_servico.divisao')
			->select(DB::raw('ordens_servico.label,ordens_servico.data,escoteiros.nome'))
			->get();
	}

	public static function getPassagens($ano,$trimestre){
		return DB::table('ordens_servico')->join('escoteiros','ordens_servico.escoteiro_id','=','escoteiros.id')
			->where('ordens_servico.type',3)
			->where('trimestre',$trimestre)
			->where('ano',$ano)
			->orderBy('ordens_servico.divisao')
			->select(DB::raw('ordens_servico.label,ordens_servico.data,escoteiros.nome'))
			->get();
	}

	public static function getProgresso($divisao,$ano,$trimestre){
		return DB::table('ordens_servico')->join('escoteiros','ordens_servico.escoteiro_id','=','escoteiros.id')
			->where('ordens_servico.type',4)
			->where('ordens_servico.trimestre',$trimestre)
			->where('ordens_servico.ano',$ano)
			->where('ordens_servico.divisao',$divisao)
			->select(DB::raw('ordens_servico.label,ordens_servico.data,escoteiros.nome'))
			->get();
	}

	public static function readifyDate($date){
		$day = explode('-',$date)[2];
		$month = explode('-',$date)[1];
		$ano = explode('-',$date)[0];

		$month = ltrim($month,'0');
		$day = ltrim($day,'0');

		return $day.' de '.OS::$meses[$month].' de '.$ano;
	}

	public static function readifyMonth($date,$cell){

		$mes = explode('-',$date)[1];
		$mes = ltrim($mes,'0');

		$cell->addText(substr(OS::$mesesDim[$mes],0,1),'bold',array('align' => 'center'));
		$cell->addText(substr(OS::$mesesDim[$mes],1,1),'bold',array('align' => 'center'));
		$cell->addText(substr(OS::$mesesDim[$mes],2,1),'bold',array('align' => 'center'));
	}
}
