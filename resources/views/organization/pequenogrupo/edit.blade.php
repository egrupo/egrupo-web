@extends('organization.default')

@section('header')
	<title>{{ $peq->name }}</title>
@stop

@section('content')
	{!! Form::model($peq, array('route' => ['pequenogrupo.update' , mySlug(),$peq->id ],'method' => 'patch','files' => true) ) !!}
	<h2 class="page-header">{{ $peq->nome }}  {!! Form::button('Guardar' ,['type' => 'submit','class' => 'btn btn-large btn-primary' ]) !!}<a onclick="return confirm('Tens a certeza que queres apagar este PequenoGrupo?');" href="{{ URL::route('pequenogrupo.destruir', [ mySlug() ,$peq->id]) }}"><span style="color: red;" class="pull-right glyphicon glyphicon-remove"></span></a></h2>
	<div class="row"> 
		<div class="col-md-4">
			<p>{!! Form::text('nome',null,array('class' => 'form-control', 'placeholder' => 'Ex: Raposa, Bando Ruivo' )) !!}</p>
			<p>{!! Form::select('divisao', [
				'0' => 'NA',
				'1' => 'Alcateia',
				'2' => 'TEs',
				'3' => 'TEx'
			], null, array('class' => 'form-control' )) !!}</p>
		</div>
	</div>
	{!! Form::close() !!}
@stop