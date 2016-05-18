<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Organization extends Model {
    
	protected $table = 'organizations';

    public function users(){
        return $this->hasMany('App\User','organization_id');
    }

    public function pequenosgrupos(){
        return $this->hasMany('App\Models\PequenoGrupo','organization_id');
    }

    public function escoteiros(){
    	return $this->hasMany('App\Models\Escoteiro','organization_id');
    }

    public function atividades(){
    	return $this->hasMany('App\Models\Ativide','organization_id');
    }

}
