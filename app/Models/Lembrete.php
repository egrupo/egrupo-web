<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;
use DateTime;

class Lembrete extends Model
{
    public $timestamps = false;
	protected $fillable = [
			'label','remindme_at','user_id','divisao','organization_id'
		];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'lembretes';

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

	public static function getLembretes($divisao){

		return Lembrete::where('divisao',$divisao)
				->where('remindme_at','<=',new DateTime('today'))
				->where('organization_id',Auth::user()->organization_id)
				->get();

	}

	public static function getAllLembretes($divisao){
		return Lembrete::where('divisao',$divisao)
						->where('organization_id',Auth::user()->organization_id)
						->get();
	}

}
