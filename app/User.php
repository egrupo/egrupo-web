<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Models\Organization;
use Validator;

use App\Models\ProvaEtapa;
use App\Models\Escoteiro;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

	/* Identificadores das divisoes */
	public static $ALCATEIA = 1;
	public static $TES = 2;
	public static $TEX = 3;
	public static $CLA = 4;
	public static $CHEFIA = 5;

	public static $ADMIN = 1;
	public static $CHEFE = 2;
	public static $CAMINHEIRO = 3;
	public static $ESCOTEIRO = 4;
	public static $EE = 5;

	public $timestamps = true;
	protected $fillable = ['user','escoteiro_id','name','email','password','level','user_type','divisao','admin','organization_id'];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('organization','password', 'remember_token');

	public static $rules = [
		'user' => 'required',
		'password' => 'required',
		'name' => 'required',
		'email' => 'required',
	];

	public $errors;

	public function isValid(){
		$validation = Validator::make($this->attributes,static::$rules);

		if($validation->passes())
			return true;

		$this->errors = $validation->messages();
		return false;
	}

	public function organization(){
        return $this->belongsTo('App\Models\Organization');
    }
    
    public function isMemberOf($org){
        return $this->organizations->contains($org->id);
    }

	public function isAdmin(){
        return $this->admin;
    }

	public static function getNome($id){
		return User::where('id',$id)->pluck('name');
	}

	public function getEscoteiroId(){
		if($this->escoteiro_id > 0){
			return Escoteiro::where('organization_id',$this->organization_id)
						->where('id_associativo',$this->escoteiro_id)
						->pluck('id');
		}

		return 0;
	}

	public function tirouProva($divisao,$etapa,$prova){
		if($this->escoteiro_id == null || $this->escoteiro_id == 0)
			return false;

		$id = Escoteiro::where('organization_id',$this->organization_id)
						->where('id_associativo',$this->escoteiro_id)->pluck('id');

		$p = ProvaEtapa::where('escoteiro_id',$id)
					->where('divisao',$divisao)
					->where('etapa',$etapa)
					->where('prova',$prova)->count();

		if($p == 0)
			return false;

		return true;
	}

}
