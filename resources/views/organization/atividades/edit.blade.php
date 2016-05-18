@extends('organization.default')

@section('header')
	<title>{{ $atividade->nome }}</title>
@stop

@section('content')
	<div class="row"></div>
	{!! Form::model($atividade, array('route' => ['atividades.update' , mySlug() , $atividade->id ],'method' => 'patch' )) !!}
	<h2 class="page-header">{{ $atividade->nome }}  {!! Form::button('Guardar' ,['type' => 'submit','class' => 'btn btn-large btn-primary' ]) !!}</h2>
	<div class="row">
		<div class="col-md-4">
			<h4 class="text-center">Informações Gerais</h4>
			<p>Nome{!! Form::text('nome',null,array('class' => 'form-control', 'placeholder' => 'Nome da atividade ')) !!}</p>
			<p>Local{!! Form::text('local',null,array('class' => 'form-control', 'placeholder' => 'Local da atividade' )) !!}</p>
			<p>Data{!! Form::input('date','performed_at',null,array('class' => 'form-control', 'placeholder' => 'Data de realização' )) !!}</p>
			<p>Duração{!! Form::text('duracao',null,array('class' => 'form-control', 'placeholder' => 'Duração da atividade' )) !!}</p>
			<p>Noites{!! Form::number('noites_campo',null,array('class' => 'form-control', 'placeholder' => '4' )) !!}</p>
			<p>Infos{!! Form::textarea('infos',null,array('class' => 'form-control', 'rows' => '3', 'placeholder' => 'Informações a mostrar aos elementos da divisão. Ex: Levar caderno de progresso, 14h no Monsanto. Levar impermeável')) !!}
			<p>Descrição{!! Form::textarea('descricao',null,array('class' => 'form-control', 'rows' => '6' ,'placeholder' => 'Peq. resumo da atividade ou outras notas' )) !!}</p>
		</div>
		<div class="col-md-5">
			<h4 class="text-center">Programa</h4>
			<p>{!! Form::textarea('programa',null,array('class' => 'form-control', 'placeholder' => 'Programa dividido por manhã/tarde/noite, horas etc.')) !!}
		</div>
		<div class="col-md-3">
			<h4 class="text-center">Objetivos</h4>
			<p>{!! Form::textarea('objetivos',null,array('class' => 'form-control', 'placeholder' => 'Objetivos da Atividade, objetivos educativos propostos para antigir e/ou atingidos')) !!}
		</div>
	</div>
	{!! Form::close() !!}
@stop