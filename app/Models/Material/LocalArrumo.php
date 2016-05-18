<?php

namespace App\Models\Material;

use Illuminate\Database\Eloquent\Model;

use Validator;
use Auth;

use App\Models\Material\Material;

class LocalArrumo extends Model
{
    public $timestamps = false;
	protected $fillable = [
			'id','divisao','nome','organization_id','last_update_at','user_id','display_order'
		];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'material_local_arrumo';

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

	public static function getLocaisArrumo($divisao){
		return LocalArrumo::where('organization_id',Auth::user()->organization_id)
				->where('divisao',$divisao)->get();
	}

	public static function getLocalArrumoArray($divisao){
		return array('0' => 'Local de Arrumação') + LocalArrumo::where('organization_id',Auth::user()->organization_id)
				->where('divisao',$divisao)->lists('nome','id')->all();
	}

	public static function getNome($id){
		return LocalArrumo::where('id',$id)->pluck('nome');
	}

	public function getMaterial(){
		return Material::where('organization_id',Auth::user()->organization_id)
			->where('divisao',$this->divisao)
			->where('local_arrumo',$this->id)
			->get();
	}
}
