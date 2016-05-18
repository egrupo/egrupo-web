@extends('organization.default')

@section('header')
	<title>Jogos</title>
@stop

@section('content')
	<div class="row">
		<h3 class="page-header text-center">Jogos</h3>
		<div class="col-md-8">
			@include('organization.jogos.list')
		</div>
		<div class="col-md-4">
			@include('organization.jogos.search')
			@include('organization.jogos.create')
		</div>
	</div>
	
@stop