<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/* 
	Index

	1 - API
	2 - Backend / users / subdomains
	3 - Admin
	4 - Frontend

*/

Route::group(['domain' => 'api.'.env('APP_HOST')],function(){
	
	Route::get('/',function(){
		return response()->json('Welcome to Egrupo API!');
	});	

	Route::post('oauth/access_token', function() {
		return Response::json(Authorizer::issueAccessToken());
	});

	Route::get('me','Api\AuthMobileController@me')->middleware('oauth');
});

/* 1 - API */
Route::group(['domain' => 'api.{slug}.'.env('APP_HOST'),'middleware' => 'organization'],function(){
	
	Route::group(['prefix' => 'v1.0/','middleware' => ['oauth','oauth-user']],function(){
		Route::get('escoteiros','Api\EscoteirosMobileController@index');
		Route::get('atividades','Api\AtividadesMobileController@index');
		Route::get('divisao/{id}/escoteiros','Api\DivisoesMobileController@escoteiros');
		Route::get('divisao/{id}/atividades','Api\DivisoesMobileController@atividades');
		Route::get('divisao/{id}/avisos','Api\DivisoesMobileController@avisos');

		Route::get('avatar/{name}','Api\EscoteirosMobileController@getAvatar');

		Route::get('escoteiro/{id}/progresso','Api\EscoteirosMobileController@getProgresso');
		Route::post('escoteiro/{id}/progresso','Api\EscoteirosMobileController@postProgresso');
		Route::get('atividade/{id}/presencas','Api\AtividadesMobileController@getPresencas');
		Route::post('atividade/{id}/presencas','Api\AtividadesMobileController@postPresencas');
		Route::post('atividade','Api\AtividadesMobileController@store');
		Route::post('escoteiro','Api\EscoteirosMobileController@store');
		Route::post('atividade/{id}/update','Api\AtividadesMobileController@update');
		Route::post('escoteiro/{id}/update','Api\EscoteirosMobileController@update');
	});

	Route::post('oauth/access_token', function() {
		return Response::json(Authorizer::issueAccessToken());
	});

	Route::group(['prefix' => 'v1.0/slack/'],function(){
		Route::post('quem','SlackController@commandQuem');
		Route::post('quando','SlackController@commandQuem');
	});

	Route::get('/',function($slug){
		return response()->json('Welcome to '.$slug.' API!');
	});

	Route::get('teste','Api\AuthMobileController@teste');

});

Route::group(['middleware' => 'csrf'],function(){

	/* 2 - Backend / users /  subdomains */
	Route::group(array('domain' => '{slug}.'.env('APP_HOST'),'middleware' => 'organization'), function(){
		
		Route::get('/','OrganizationController@login');
		Route::post('/','OrganizationController@store');
		Route::get('logout','OrganizationController@destroy');

		/* Pages */
		Route::get('dashboard','WebpageController@showDashboard')->middleware('auth.organization');

		Route::resource('escoteiros','EscoteirosController');
		Route::resource('atividades','AtividadesController');
		Route::get('atividade/{atividade_id}/divisao/{divisao_id}',['as' => 'atividades.show.divisao','uses' => 'AtividadesController@showDivisao']);
		Route::resource('users','UsersController');
		Route::resource('os','OSController');
		Route::resource('lembretes','LembretesController');
		Route::resource('contactos','ContactosController');
		Route::resource('avisos','AvisosController');
		Route::resource('jogos','JogosController');
		Route::resource('pequenogrupo','PequenoGrupoController');
		/* Material Related */
		Route::resource('material','Material\MaterialController');
		Route::resource('categoria','Material\CategoriaController');
		Route::resource('localarrumo','Material\LocalArrumoController');
		/* Admin Related */
		Route::resource('informacao','Admin\InformacaoController');

		Route::get('admin','WebpageController@showAdmin')->middleware(['auth.organization','admin']);
		Route::get('mudardivisao/{divisao_id}',['as' => 'user.mudardivisao','uses' => 'UsersController@mudarDivisao'])->middleware('auth.organization');
		Route::get('password',['as' => 'user.showchangepassword','uses' => 'UsersController@showChangePassword'])->middleware('auth.organization');
		Route::Post('password',['as' => 'user.changepassword','uses' => 'UsersController@changePassword'])->middleware('auth.organization');

		/* Divisoes */
		Route::group(['prefix' => 'divisao/{label}/', 'as' => 'divisoes.','middleware' => 'auth.organization'],function(){
			Route::get('',['as' => 'show','uses' => 'DivisoesController@showDivisao']);
			Route::get('escoteiros',['as' => 'escoteiros' , 'uses' => 'DivisoesController@showEscoteiros' ]);
			Route::get('atividades',['as' => 'atividades', 'uses' => 'DivisoesController@showAtividades' ]);
			Route::Get('material',['as' => 'material', 'uses' => 'DivisoesController@showMaterial']);
			Route::get('desafios',['as' => 'desafios' , 'uses' => 'DivisoesController@showDesafios' ]);
			Route::get('pad',['as' => 'pad', 'uses' => 'DivisoesController@showPad']);
			Route::get('atividades/todas',['as' => 'atividades.todas','uses' => 'DivisoesController@showAtividadesTodas']);
			Route::get('os/todas',['as' => 'os.todas','uses' => 'DivisoesController@showOSTodas']);	
			Route::get('progresso',['as' => 'progresso','uses' => 'DivisoesController@progresso']);
		});

		/* Escoteiros */
		Route::group(['prefix' => 'escoteiros/{id}/' ,'as' => 'escoteiros.' ,'middleware' => 'auth.organization'],function(){
			Route::post('concluirProvaEtapa',['as' => 'concluirprovaetapa','uses' => 'EscoteirosController@concluirProvaEtapa']);
			Route::post('desconcluirProvaEtapa',['as' => 'desconcluirprovaetapa','uses' => 'EscoteirosController@desconcluirProvaEtapa']);
			Route::post('desconcluirProvaEspecialidade',['as' => 'desconcluirprovaespecialidade','uses' => 'EscoteirosController@desconcluirProvaEspecialidade']);
			Route::post('concluirEtapa',['as'=>'concluiretapa','uses' => 'EscoteirosController@concluirEtapa']);
			Route::post('concluirProvaEspecialidade',['as' => 'concluirprovaespecialidade','uses' => 'EscoteirosController@concluirProvaEspecialidade']);
			Route::post('concluirEspecialidade',['as' => 'concluirespecialidade' ,'uses' => 'EscoteirosController@concluirEspecialidade']);
			Route::get('progresso',['as' => 'showprogresso','uses' => 'EscoteirosController@showProgresso']);
			Route::get('especialidades',['as' => 'showprogressoespecialidades','uses' => 'EscoteirosController@showProgressoEspecialidades']);
			Route::get('presencas',['as' => 'showpresencas','uses' => 'EscoteirosController@showPresencas']);
		});

		Route::post('escoteiros/concluirProvas',['as' => 'escoteiros.concluirprovas','uses' => 'EscoteirosController@concluirProvas'])->middleware('auth.organization');

		/* Atividades */
		Route::group(['prefix' => 'atividades/{id}/', 'as' => 'atividades.','middleware' => 'auth.organization'],function(){
			Route::get('marcar/{divisao_id}',['as' => 'marcarpresencas' ,'uses' => 'AtividadesController@showMarcarPresencas']);
			Route::post('marcar/{divisao_id}',['as' => 'marcarpresencas' ,'uses' => 'AtividadesController@marcarPresencas']);
			Route::get('alterar',['as' => 'alterarpresencas' ,'uses' => 'AtividadesController@showAlterarPresencas']);
			Route::post('alterar',['as' => 'alterarpresencas' ,'uses' => 'AtividadesController@alterarPresencas']);
			Route::post('registar',['as' => 'registardescricao','uses' => 'AtividadesController@guardarRegistoAtividade']);
		});

		/* Destruir */
		Route::get('os/{id}/destroy',['as' => 'os.destruir', 'uses' => 'OSController@destroy'])->middleware('auth.organization');
		Route::get('contactos/{id}/destroy',['as' => 'contacto.destruir', 'uses' => 'ContactosController@destroy'])->middleware('auth.organization');
		Route::get('avisos/{id}/destroy',['as' => 'aviso.destruir', 'uses' => 'AvisosController@destroy'])->middleware('auth.organization');
		Route::get('lembrete/{id}/destroy',['as' => 'lembrete.destruir','uses' => 'LembretesController@destroy'])->middleware('auth.organization');
		// Route::get('area/{id}/destroy',['as' => 'area.destruir','uses' => 'AreaController@destroy'])->middleware('auth.organization');
		Route::get('users/{id}/destroy',['as' => 'users.destruir','uses' => 'UsersController@destroy'])->middleware('auth.organization'); //middleware admin?
		Route::get('pequenogrupo/{id}/destroy',['as' => 'pequenogrupo.destruir', 'uses' => 'PequenoGrupoController@destroy'])->middleware('auth.organization');
		Route::get('users/{id}/destroy',['as' => 'users.destruir','uses' => 'UsersController@destroy'])->middleware('auth.organization');
		Route::get('localarrumo/{id}/destroy',['as' => 'localarrumo.destruir','uses' => 'Material\LocalArrumoController@destroy'])->middleware('auth.organization');
		Route::get('material/{id}/destroy',['as' => 'material.destruir','uses' => 'Material\MaterialController@destroy'])->middleware('auth.organization');
		Route::get('categoria/{id}/destroy',['as' => 'categoria.destruir','uses' => 'Material\CategoriaController@destroy'])->middleware('auth.organization');

		Route::get('desafios','WebpageController@showDesafios')->middleware('auth.organization');
		Route::get('jogos','WebpageController@showJogos')->middleware('auth.organization');
		Route::post('jogos/search',['as' => 'jogos.search', 'uses' => 'JogosController@search'])->middleware('auth.organization');
		Route::post('search',['as' => 'search', 'uses' => 'WebpageController@searchPerson'])->middleware('auth.organization');

		Route::get('cartaoescoteiro','WebpageController@showCartaoEscoteiro')->before('auth.organization');
		Route::post('cartaoescoteiro','WebpageController@showCartaoEscoteiroR')->before('auth.organization');
		Route::get('pnec','WebpageController@showPNEC')->before('auth.organization');
		Route::post('pnec','WebpageController@showPNECR')->before('auth.organization');
		Route::get('objetivos','WebpageController@showObjetivos')->before('auth.organization');

		Route::get('os','WebpageController@showOs')->before('auth.organization');
		Route::post('geraros',['as' => 'geraros', 'uses' => 'OSController@gerarOS'])->before('auth.organization');
		Route::get('downloados/{name}',['as' => 'os.download','uses' => 'OSController@downloadOS'])->before('auth.organization');
		Route::get('osfile/{name}/destroy',['as' => 'osfile.destruir','uses' => 'OSController@destroyOSFile'])->before('auth.organization');

		Route::get('avatar/{name}','EscoteirosController@getAvatar');
	});

	Route::get('logout','SessionsController@destroy');

	/* 3 - Admin */
	Route::get('admin','AdminController@login');
	Route::post('admin','AdminController@store');
	Route::get('admin/logout','AdminController@destroy');
	Route::get('admin/dashboard','AdminController@showDashboard');

	/* 4 - FrontEnd */
	Route::get('signup','OrganizationController@create');
	Route::post('signup','OrganizationController@register');

	Route::resource('invites','BetaInviteController');

	Route::get('/',['as' => 'home', 'uses' => 'FrontendController@showHome']);
	Route::get('pricing','FrontendController@showPricing');
	Route::get('contact','FrontendController@showContact');
	Route::get('tour','FrontendController@showTour');

	Route::post('contact','FrontendController@sendMessage');
});