@extends('organization.default')

@section('header')
	<title>Dashboard - {{ Auth::user()->name }} </title>
	{!! Html::script('js/Chart.min.js') !!}
	{!! Html::script('js/dashboard.js') !!}
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			Pais
		</div>
	</div>
@stop