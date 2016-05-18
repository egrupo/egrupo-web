<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Validator;

class BetaInvite extends Model
{
    /**
   * Properties that can be mass assigned
   *
   * @var array
   */
  protected $fillable = array('code', 'email','nome','npessoas','numero_grupo');

  protected $table = 'invites';

  public static $rules = [
    'npessoas' => 'required|numeric',
    'numero_grupo' => 'required|numeric',
    'nome' => 'required',
    'email' => 'required|email',
  ];

  public function isValid(){
    $validation = Validator::make($this->attributes,static::$rules);

    if($validation->passes())
      return true;

    $this->errors = $validation->messages();
    return false;
  }

  public function getValidInviteByCode($code) {
    return BetaInvite::where('code', '=', $code)
                       ->where('claimed_at', '=', null)
                       ->first();
  }

}
