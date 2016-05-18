<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Contacto extends Model
{
    public $timestamps = true;
	protected $fillable = [
			'divisao','nome','designacao','contacto','organization_id'
		];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'contactos';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public static $rules = [

	];

	public $errors;

	public function organization(){
        return $this->belongsTo('App\Models\Organization','organization_id');
    }

    public function scopeGrupo($query){
		return $query->where('organization_id',Auth::user()->organization_id);
	}

	public static function getContactos($divisao){
		return Contacto::where('divisao',$divisao)
						->grupo()
						->get();
	}
}
