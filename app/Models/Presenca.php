<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presenca extends Model
{
    public static $PRESENTE = 1;
	public static $FALTA = 0;

	public $timestamps = true;
	protected $fillable = [
			'id','atividade_id','user_id','tipo','created_at','updated_at'
		];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'presencas';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public static $rules = [
		
	];

	public function escoteiro() {
        return $this->belongsTo('App\Models\Escoteiro', 'user_id');
    }

    public function atividade() {
        return $this->belongsTo('App\Models\Atividade', 'atividade_id');
    }

	public $errors;

	public function toString(){
		Log::info('User id '.$this->user_id.' esteve '.$this->tipo.' na atividade '.$this->atividade_id);
	}

	public static function getLabel($tipo){
		switch ($tipo) {
			case self::$PRESENTE:
				return 'Presente';
			case self::$FALTA:
				return 'Falta';
		}
	}
}
