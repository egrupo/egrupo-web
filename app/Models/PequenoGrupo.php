<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;
use App\User;
use Auth;

use Validator;

class PequenoGrupo extends Model
{
    public $timestamps = false;
	protected $fillable = [
			'id','divisao','nome','organization_id'
		];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pequeno_grupo';

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

	public function isValid(){
		$validation = Validator::make($this->attributes,static::$rules);

		if($validation->passes())
			return true;

		$this->errors = $validation->messages();
		return false;
	}

	public static function getPequenoGrupoArray($divisao){
		$peqs_grupo = DB::table('pequeno_grupo')
				->where('organization_id',Auth::user()->organization_id)
				->where('divisao','=',$divisao)->get();

		$res = array('' => 'Patrulha/Bando');

		foreach($peqs_grupo as $e){
			$res = array_merge($res, array($e->nome => $e->nome));
		}

		return $res;
	}
}
