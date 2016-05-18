@extends('organization.default')

@section('header')
	<title>Cadernos de Provas</title>
@stop

@section('content')
	<div class="row">
		<div class="col-md-9">
			<h3 class="page-header text-center">Cadernos de Provas</h3>
			<div role="tabpanel">
					<!-- Nav tabs -->
				<ul class="nav nav-pills" role="tablist">
				    <li role="presentation" class="active"><a href="#etapa_1" aria-controls="etapa_1" role="tab" data-toggle="tab">{{ App\Models\Etapa::getLabel(1,$id) }}</a></li>
				    <li role="presentation"><a href="#etapa_2" aria-controls="etapa_2" role="tab" data-toggle="tab">{{ App\Models\Etapa::getLabel(2,$id) }}</a></li>
				    <li role="presentation"><a href="#etapa_3" aria-controls="etapa_3" role="tab" data-toggle="tab">{{ App\Models\Etapa::getLabel(3,$id) }}</a></li>
				    <li role="presentation"><a href="#etapa_e" aria-controls="etapa_e" role="tab" data-toggle="tab">Especialidades</a></li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content" style="margin-top: 25px;">
				    <div role="tabpanel" class="tab-pane active" id="etapa_1">
				    	@include('organization.progresso.recurso_etapa',array('caderno' => $caderno1))
				    </div>
				    <div role="tabpanel" class="tab-pane" id="etapa_2">
				    	@include('organization.progresso.recurso_etapa',array('caderno' => $caderno2))
				    </div>
				    <div role="tabpanel" class="tab-pane" id="etapa_3">
				    	@include('organization.progresso.recurso_etapa',array('caderno' => $caderno3))
				    </div>
				    <div role="tabpanel" class="tab-pane" id="etapa_e">
				    	@include('organization.progresso.recurso_especialidade', array('especialidades' => $especialidades))
				    </div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div style="position: fixed; width: 243px; margin-top: 40px">
				<ul class="nav nav-pills nav-stacked">
					<li class="nav-header"><h3 style="text-align: center;">Divisões</h3></li>
					<li class="nav-item {{ $id == App\User::$ALCATEIA ? 'active' : ''}}"><a href="{{ URL::route('divisoes.desafios' , [mySlug() , 'Alcateia'] ) }}">Alcateia</a></li>
					<li class="nav-item {{ $id == App\User::$TES ? 'active' : ''}}"><a href="{{ URL::route('divisoes.desafios' , [mySlug() , 'TEs'] ) }}">TEs</a></li>
					<li class="nav-item {{ $id == App\User::$TEX ? 'active' : ''}}"><a href="{{ URL::route('divisoes.desafios' , [mySlug() , 'TEx'] ) }}">TEx</a></li>
					<li class="nav-item {{ $id == App\User::$CLA ? 'active' : ''}}"><a href="{{ URL::route('divisoes.desafios' , [mySlug() , 'Cla'] ) }}">Clã</a></li>
				</ul>

				<div class="google-play-badge" style="margin-top: 50px;">
					<a href="https://play.google.com/store/apps/details?id=pt.ruie.cadernoprogresso">
					  <img alt="Get it on Google Play"
					       src="../../images/google-play-badge.png" />
					</a>
				</div>
			</div>
		</div>
	</div>
@stop