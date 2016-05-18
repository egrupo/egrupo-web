<?php

namespace App\Models\Material;

use Illuminate\Database\Eloquent\Model;

use App\Models\Material\Categoria;

use Auth;
use Validator;

class Material extends Model
{
    public $timestamps = true;
	protected $fillable = [
			'id','organization_id','divisao','categoria_id','local_arrumo','estado','quantidade','nome','notas'
		];

	public static $messages = array(
			'categoria_id.required' => 'Tens de atribuir uma categoria ao material',
            'nome.required' => 'Tens de dar um nome à peça de material'
    );
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'material';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public static $rules = [
		'nome' => 'required',
		'local_arrumo' => 'required|exists:material_local_arrumo,id',
	];

	public $errors;

	public function isValid(){
		$validation = Validator::make($this->attributes,static::$rules,static::$messages);

		if($validation->passes())
			return true;

		$this->errors = $validation->messages();
		return false;
	}

	public function scopeGrupo($query){
		return $query->where('organization_id',Auth::user()->organization_id);
	}

}
