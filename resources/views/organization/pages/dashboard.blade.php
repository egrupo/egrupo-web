@extends('organization.default')

@section('header')
	<title>Dashboard - {{ Auth::user()->name }} </title>
@stop

@section('content')
	<div class="row">
		<div class="col-md-5">
			<h4 class="page-header">Alertas e Lembretes</h4>
			@if($warn_atividades > 0)
				<div class="alert alert-warning">
					Tens <strong>{{ $warn_atividades }}</strong> <a href="{{ URL::route('divisoes.atividades',[mySlug(), App\Models\Divisao::getLabel(Auth::user()->divisao)]) }}">atividades</a> sem presenças!
				</div>
			@endif

			@foreach(App\Models\Lembrete::getLembretes(Auth::user()->divisao) as $lembrete)
				<div class="alert alert-warning">
					{{ $lembrete->label }}
				</div>
			@endforeach()

			@if($warn_n_escoteiros)
				<div class="alert alert-warning">
					Ainda não tens escoteiros. Começa a inserir no menu 'Elementos'.
				</div>
			@endif

			@if($warn_n_atividades)
				<div class="alert alert-warning">
					Ainda não tens atividades criadas. Começa a inseri-las no menu 'Atividades'.
				</div>
			@endif

			@if($warn_atividades == 0 && $warn_lembretes == 0 && !$warn_n_atividades && !$warn_n_escoteiros)
				<div class="alert alert-success">
					Não tens quaisquer alertas/lembretes :)
				</div>
			@endif


		</div>

		<div class="col-md-7">
			<h4 class="page-header">Informações</h4>
		</div>
	</div>

	<!-- values for the charts -->
	<input type="hidden" id="num-alc" value="{{ $num_elems[0] }}" />
	<input type="hidden" id="num-tes" value="{{ $num_elems[1] }}" />
	<input type="hidden" id="num-tex" value="{{ $num_elems[2] }}" />
	<input type="hidden" id="num-cla" value="{{ $num_elems[3] }}" />
	<input type="hidden" id="num-che" value="{{ $num_elems[4] }}" />

	<input type="hidden" id="num-alc-1" value="{{ App\Models\Etapa::getEtapaCount(App\Models\Divisao::$ALCATEIA,1) }}" />
	<input type="hidden" id="num-alc-2" value="{{ App\Models\Etapa::getEtapaCount(App\Models\Divisao::$ALCATEIA,2) }}" />
	<input type="hidden" id="num-alc-3" value="{{ App\Models\Etapa::getEtapaCount(App\Models\Divisao::$ALCATEIA,3) }}" />

	<input type="hidden" id="num-tes-1" value="{{ App\Models\Etapa::getEtapaCount(App\Models\Divisao::$TES,1) }}" />
	<input type="hidden" id="num-tes-2" value="{{ App\Models\Etapa::getEtapaCount(App\Models\Divisao::$TES,2) }}" />
	<input type="hidden" id="num-tes-3" value="{{ App\Models\Etapa::getEtapaCount(App\Models\Divisao::$TES,3) }}" />

	<input type="hidden" id="num-tex-1" value="{{ App\Models\Etapa::getEtapaCount(App\Models\Divisao::$TEX,1) }}" />
	<input type="hidden" id="num-tex-2" value="{{ App\Models\Etapa::getEtapaCount(App\Models\Divisao::$TEX,2) }}" />
	<input type="hidden" id="num-tex-3" value="{{ App\Models\Etapa::getEtapaCount(App\Models\Divisao::$TEX,3) }}" />

	<input type="hidden" id="num-cla-1" value="{{ App\Models\Etapa::getEtapaCount(App\Models\Divisao::$CLA,1) }}" />
	<input type="hidden" id="num-cla-2" value="{{ App\Models\Etapa::getEtapaCount(App\Models\Divisao::$CLA,2) }}" />
	<input type="hidden" id="num-cla-3" value="{{ App\Models\Etapa::getEtapaCount(App\Models\Divisao::$CLA,3) }}" />

	<div class="row">
		<div class="col-md-3">
			<h3 class="page-header text-center">#Escoteiros</h3>
			<div class="center size200">
				<canvas id="chart-escoteiros" width="200" height="200" style="width: 200px; height: 200px;"></canvas>
			</div>
			<h5 class="text-center">
				Total de escoteiros: {{ $num_elems[0]+$num_elems[1]+$num_elems[2]+$num_elems[3]+$num_elems[4] }}
			</h5>
		</div>
		<div class="col-md-9">
			<h3 class="page-header text-center">#Etapas (1ª, 2ª, 3ª etapas)</h3>
			<div class="center">
				<canvas id="chart-etapas" width="750" height="250" style="width: 100%;height: 250px;"></canvas>
			</div>
		</div>
	</div>

	<!-- <div class="row">
		<h3 class="page-header text-center">%Assiduidade</h3>
		<div class="center">
				<canvas id="chart-assiduidade" width="1200" height="400" style="width: 100%;height: 200px;"></canvas>
			</div>
	</div> -->
<!--
	<h4 class="page-header">Distribuição de Etapas</h4>
	<div class="row">

	</div>
-->
@stop

@section('scripts')
	{!! Html::script('js/Chart.min.js') !!}
	{!! Html::script('js/dashboard.js') !!}
@stop