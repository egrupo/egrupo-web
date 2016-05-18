@extends('layouts.default')

@section('header')
	<title>PAD - {{ Divisao::getLabel($id) }}</title>
@stop

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h3 class="page-header">Áreas Prioritárias</h3>
			@foreach(AreaPrioritaria::getAreas($id) as $area)
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>{{ $area->label }}</strong> - {{ $area->descricao }}
					</div>
					<div class="panel-body">
						iterar objetivos gerais
					</div>
				</div>
			@endforeach
		</div>
		<div class="col-md-4">
			@include('areas-prioritarias.create',['divisao_id' => $id])
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<h3 class="page-header">Objetivos Trimestrais</h3>
		</div>
		<div class="col-md-4">

		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<h3 class="page-header">Ações</h3>
		</div>
		<div class="col-md-4">

		</div>

	</div>
	
@stop