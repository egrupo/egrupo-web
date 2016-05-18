@extends('organization.default')

@section('header')
	<title>{{ $user->name }}</title>
@stop

@section('content')
	{!! Form::model($user, array('route' => ['users.update' , mySlug(),$user->id ],'method' => 'patch','files' => true) ) !!}
	<div class="row"> 
		<h2 class="page-header">{{ $user->name }}  {!! Form::button('Guardar' ,['type' => 'submit','class' => 'btn btn-large btn-primary' ]) !!}<a onclick="return confirm('Tens a certeza que queres apagar este User?');" href="{{ URL::route('users.destruir', [ mySlug() ,$user->id]) }}"><span style="color: red;" class="pull-right glyphicon glyphicon-remove"></span></a></h2>	
		<div class="col-md-4">
			<p>{!! Form::text('escoteiro_id',null,array('class' => 'form-control', 'placeholder' => 'Número Associativo' )) !!}</p>
			<p>{!! Form::text('email',null,array('class' => 'form-control', 'placeholder' => 'nome.esoteiro@email.com' )) !!}</p>
			<p>{!! Form::select('level', [
				'1' => 'Admin',
				'2' => 'Chefe',
				'3' => 'Caminheiro',
				'4' => 'Escoteiro',
				'5' => 'EE'
			], null, array('class' => 'form-control' )) !!}</p>
			<p>{!! Form::select('divisao', [
				'0' => 'NA',
				'1' => 'Alcateia',
				'2' => 'TEs',
				'3' => 'TEx',
				'4' => 'Clã',
				'5' => 'Chefia'
			], null, array('class' => 'form-control' )) !!}</p>
		</div>
	</div>
	{!! Form::close() !!}
@stop