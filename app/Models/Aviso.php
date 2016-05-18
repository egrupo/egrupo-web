<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;
use App\Models\Escoteiro;

class Aviso extends Model
{
    public static $INDIVIDUAL = 1;
	public static $GRUPO = 2;

	public $timestamps = true;
	protected $fillable = [
			'tipo','target_id','descricao','organization_id'
		];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'avisos';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public static $rules = [
		
	];

	public $errors;

	public function scopeGrupo($query){
		return $query->where('organization_id',Auth::user()->organization_id);
	}

	public static function getAvisos($divisao){
		$e = Escoteiro::where('divisao',$divisao)->where('organization_id',Auth::user()->organization_id)->lists('id');

		if($e){
			$a = Aviso::where(function($query) use ($e){
				$query->where('tipo',Aviso::$INDIVIDUAL)
				->where('organization_id',Auth::user()->organization_id)
				->whereIn('target_id',$e);
			})->orWhere(function($query) use ($divisao){
				$query->where('tipo',Aviso::$GRUPO)
				->where('organization_id',Auth::user()->organization_id)
				->where('target_id',$divisao);
			})->orderBy('tipo','DESC')->get();

			return $a;
		} else {
			$a = Aviso::where('tipo',Aviso::$GRUPO)
						->where('organization_id',Auth::user()->organization_id)
						->where('target_id',$divisao)->get();

			return $a;
		}
	}
}
