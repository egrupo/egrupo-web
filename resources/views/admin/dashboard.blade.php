@extends('admin.default')

@section('title')
	<title>Admin - Dasboard</title>
@stop

@section('content')

	<div id="page-wrapper">

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-3 col-md-6">
	            <div class="panel panel-yellow">
	                <div class="panel-heading">
	                    <div class="row">
	                        <div class="col-xs-3">
	                            <i class="fa fa-user fa-5x"></i>
	                        </div>
	                        <div class="col-xs-9 text-right">
	                            <div class="huge">{{ App\AdminUtils::getTotals(App\Models\Divisao::$ALCATEIA) }}</div>
	                            <div>Lobitos</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>

	        <div class="col-lg-3 col-md-6">
	            <div class="panel panel-green">
	                <div class="panel-heading">
	                    <div class="row">
	                        <div class="col-xs-3">
	                            <i class="fa fa-user fa-5x"></i>
	                        </div>
	                        <div class="col-xs-9 text-right">
	                            <div class="huge">{{ App\AdminUtils::getTotals(App\Models\Divisao::$TES) }}</div>
	                            <div>Escoteiros</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>

	        <div class="col-lg-3 col-md-6">
	            <div class="panel panel-primary">
	                <div class="panel-heading">
	                    <div class="row">
	                        <div class="col-xs-3">
	                            <i class="fa fa-user fa-5x"></i>
	                        </div>
	                        <div class="col-xs-9 text-right">
	                            <div class="huge">{{ App\AdminUtils::getTotals(App\Models\Divisao::$TEX) }}</div>
	                            <div>Exploradores</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>

	        <div class="col-lg-3 col-md-6">
	            <div class="panel panel-red">
	                <div class="panel-heading">
	                    <div class="row">
	                        <div class="col-xs-3">
	                            <i class="fa fa-user fa-5x"></i>
	                        </div>
	                        <div class="col-xs-9 text-right">
	                            <div class="huge">{{ App\AdminUtils::getTotals(App\Models\Divisao::$CLA) }}</div>
	                            <div>Caminheiros</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">Grupos</h3>
				@foreach(App\Models\Organization::all() as $org)
					<div class="row">
						<div class="col-md-2"> {{ $org->number }} </div>
						<div class="col-md-2"> {{ $org->email }} </div>
						<div class="col-md-2"> {{ $org->telemovel }} </div>
						<div class="col-md-2"> {{ $org->localidade }}</div>
					</div>
				@endforeach
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">Inscrições</h3>
				<div class="row">
						<div class="col-md-3"><strong>Código</strong></div>
						<div class="col-md-3"><strong>Email</strong></div>
						<div class="col-md-2"><strong>Nome</strong></div>
						<div class="col-md-1"><strong>PAX</strong></div>
						<div class="col-md-1"><strong>Grupo</strong></div>
					</div>
				@foreach(App\Models\BetaInvite::all() as $invite)
					<div class="row">
						<div class="col-md-3"> {{ $invite->code }} </div>
						<div class="col-md-3"> {{ $invite->email }} </div>
						<div class="col-md-2"> {{ $invite->nome }} </div>
						<div class="col-md-1"> {{ $invite->n_pessoas }}</div>
						<div class="col-md-1"> {{ $invite->numero_grupo }}</div>
					</div>
				@endforeach
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">Last Login At</h3>
				@foreach(App\AdminUtils::getLastLogin() as $user)
					<div class="row">
						<div class="col-md-3"> {{ $user->name }} </div>
						<div class="col-md-3"> {{ $user->organization->slug }} </div>
						<div class="col-md-3"> {{ $user->last_login_at }} </div>
					</div>
				@endforeach
			</div>
		</div>

	</div>
@stop