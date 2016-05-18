<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProvaEspecialidade extends Model
{
    public $timestamps = false;
	protected $fillable = [
			'id','prova','escoteiro_id','especialidade','concluded_at'
		];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'provas_especialidade';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public static $rules = [
		// 'divisao' => 'required',
		// 'nome' => 'required',
		// 'id' => 'required|integer'
	];

	public $errors;

}
