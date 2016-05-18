<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Divisao;
use Auth;
use Validator;

class Jogo extends Model
{
    public $timestamps = false;
	protected $fillable = [
			'nome','descricao','duracao','n_participantes','divisoes','organization_id'
		];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'recursos_jogos';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public static $rules = [
		'nome' => 'required',
		'duracao' => 'required|integer',
		'n_participantes' => 'required|integer'
	];

	public $errors;

	public function isValid(){
		$validation = Validator::make($this->attributes,static::$rules);

		if($validation->passes())
			return true;

		$this->messages = $validation->messages();
		return false;
	}

	public function scopeGrupo($query){
		return $query->where('organization_id',Auth::user()->organization_id);
	}

	public static function getDivisoesFromField($divisoes){
		$temp = explode(',',$divisoes);

		$res = '';

		foreach($temp as $div){
			$res .= Divisao::getLabel($div).' ';
		}

		return $res;
	}

	public function getDivisoesArray(){
		return explode(',',$this->divisoes);
	}
}
