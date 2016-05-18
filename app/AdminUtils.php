<?php

namespace App;

use App\Models\Escoteiro;
use App\Models\Etapa;
use App\Models\Atividade;
use App\Models\Divisao;
use App\Models\Organization;
use App\User;

class AdminUtils
{

	public static function getTotals($divisao){
		return Escoteiro::where('divisao',$divisao)->count();
	}

	public static function getGrupos(){
		return Organization::all();
	}

	public static function getLastLogin(){
		return User::where('user_type','1')->orderBy('last_login_at','DESC')->take(15)->get();
	}

	public static function getFrontendEscoteiros(){
		$escoteiros = Escoteiro::where('divisao','<=',Divisao::$CLA)->count();
		$escoteiros = floor($escoteiros / 10) * 10;
		return $escoteiros;
	}

	public static function getFrontendAtividades(){
		$atividades = Atividade::count();
		$atividades = floor($atividades / 10) * 10;
		return $atividades;
	}

	public static function getFrontendEtapas(){
		$etapas = Etapa::count();
		$etapas = floor($etapas / 10) * 10;
		return $etapas;
	}

}