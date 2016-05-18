<?php

namespace App\Models\Material;

use Illuminate\Database\Eloquent\Model;

use Validator;
use Auth;

class Categoria extends Model
{
    public $timestamps = false;
	protected $fillable = [
			'id','nome','organization_id'
		];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'material_categoria';

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

	public static function getCategoriaArray(){
		return array('0' => 'Categoria') + Categoria::where('organization_id',Auth::user()->organization_id)
				->lists('nome','id')->all();
	}

	public static function getNome($id){
		return Categoria::where('id',$id)->pluck('nome');
	}

	public static function getMaterialOrderByCategoria($divisao){
		return Material::where('organization_id',Auth::user()->organization_id)
				->where('divisao',$divisao)
				->orderBy('categoria_id')
				->get();
	}
}
