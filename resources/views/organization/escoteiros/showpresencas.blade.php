@extends('organization.default')

@section('header')
	<title>Presenças - {{ $escoteiro->nome }} </title>
@stop

@section('content')
	<div class="row"></div>
	@foreach($anos as $ano)
		<h2 class="page-header text-center">{{ $ano->ano }}</h2>
		@include('organization.presencas.ano', array('escoteiro' => $escoteiro, 'ano' => $ano->ano))
	@endforeach
@stop