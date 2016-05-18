@extends('organization.default')

@section('header')
	<title>Especialidades - {{ $escoteiro->nome }} </title>
	<meta name="_token" content="{{ csrf_token() }}"/>
@stop

@section('content')
		<div class="row"></div>
		
		<h2 class="page-header"><a href="{{ URL::route('escoteiros.show', [mySlug(),$escoteiro->id]) }}"><small><span class="glyphicon glyphicon-menu-left"></span></small> {{ $escoteiro->nome }}</a></h2>
		@if(Auth::user()->level <= App\User::$CAMINHEIRO)
			@include('organization.progresso.gravar', array('escoteiro' => $escoteiro ,'total' => true))	
		@endif

		<h2 class="page-header">Alcateia</h2>
		@include('organization.progresso.especialidade', array('divisao' => App\User::$ALCATEIA , 'escoteiro' => $escoteiro))

		<h2 class="page-header">TEs</h2>
		@include('organization.progresso.especialidade', array('divisao' => App\User::$TES , 'escoteiro' => $escoteiro))

		<h2 class="page-header">TEx</h2>
		@include('organization.progresso.especialidade', array('divisao' => App\User::$TEX , 'escoteiro' => $escoteiro))

		<h2 class="page-header">Clã</h2>
		@include('organization.progresso.especialidade', array('divisao' => App\User::$CLA , 'escoteiro' => $escoteiro))

@stop

@section('scripts')
	<script type="text/javascript" src="{{ URL::asset('js/masonry.pkgd.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/progressoespecialidade.js') }}"></script>
@stop