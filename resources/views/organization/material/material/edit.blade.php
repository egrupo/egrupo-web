@extends('organization.default')

@section('header')
	<title>{{ $material->nome }}</title>
@stop

@section('content')
	<div class="row">
		{!! Form::model($material, array('route' => ['material.update' , mySlug() , $material->id ],'method' => 'patch' )) !!}
		<h2 class="page-header">
			<!-- <a href="{{ URL::route('divisoes.material' , [mySlug(),App\Models\Divisao::getLabel($material->divisao)]) }}"><small><span class="glyphicon glyphicon-menu-left"></small></a> -->
			{{ $material->nome }}  {!! Form::button('Guardar' ,['type' => 'submit','class' => 'btn btn-large btn-primary' ]) !!}
			<a onclick="return confirm('Tens a certeza que queres apagar esta peça de material?');" style="color: red" class="pull-right" href="{{ URL::route('material.destruir',[mySlug(),$material->id,'true']) }}"><i class="glyphicon glyphicon-remove"></i></a>
		</h2>
		<div class="row">
			<div class="col-md-6">
				<p>Nome 
					{!! Form::text('nome',null,array('class' => 'form-control', 'placeholder' => 'Nome da atividade ')) !!}</p>
				<p>Local de Arrumação
					{!! Form::select('local_arrumo',App\Models\Material\LocalArrumo::getLocalArrumoArray($material->divisao),$material->local_arrumo,array('class' => 'form-control')) !!}</p>
				<p>Categoria
					{!! Form::select('categoria_id',App\Models\Material\Categoria::getCategoriaArray(),$material->categoria_id,array('class' => 'form-control')) !!}</p>
			</div>
			<div class="col-md-6">
				<p>Estado
					{!! Form::select('estado',App\Models\Material\Estado::getEstadosArray(),$material->estado,array('class' => 'form-control')) !!}</p>
				<p>Quantidade{!! Form::number('quantidade',null,array('class' => 'form-control', 'placeholder' => '37' )) !!}</p>
				<p>Notas{!! Form::text('notas',null,array('class' => 'form-control', 'placeholder' => 'Por ex: Emprestado à Tribo de Exploradores. Faltam 3 estacas.')) !!}
			</div>
		</div>
		{!! Form::close() !!}
	</div>
	<div class="spacer"></div>
	<h4>Dica - Legenda de Cores</h4>
	<div class="well">
		<div class="row">
			<div class="col-md-3 alert">Uma peça de material sem estado não aparece sinalizado</div>
			<div class="col-md-3 alert alert-success">Uma peça de material com o estado <strong>'Completo'</strong> aparece sinalizado a verde.</div>
			<div class="col-md-3 alert alert-warning">Uma peça de material com o estado <strong>'Incompleto'</strong> aparece sinalizado a amarelo.</div>
			<div class="col-md-3 alert alert-danger">Uma peça de material com o estado <strong>'Danificado'</strong> aparece sinalizado a vermelho.</div>
		</div>
	</div>
@stop