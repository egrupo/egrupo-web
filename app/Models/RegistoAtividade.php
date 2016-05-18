<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;

class RegistoAtividade extends Model
{
    public $timestamps = true;
	protected $fillable = [
			'escoteiro_id','atividade_id','organization_id','descricao','created_at','updated_at'
		];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'registo_atividades';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public static $rules = [
		'escoteiro_id' => 'required',
		'atividade_id' => 'required'
	];

	public $errors;

	public static function getDescricao($escoteiro_id,$atividade_id){
		return RegistoAtividade::where('escoteiro_id',$escoteiro_id)
								->where('organization_id',Auth::user()->organization_id)
								 ->where('atividade_id',$atividade_id)
								 ->pluck('descricao');
	}
}
