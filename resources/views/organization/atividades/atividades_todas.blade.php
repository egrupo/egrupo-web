@extends('organization.default')

@section('header')
	<title>Atividades {{ $label }} </title>
@stop

@section('content')
	@foreach($anos as $ano)
		@include('organization.atividades.yearview',array('ano' => $ano->ano, 'atividades' => App\Models\Atividade::getAtividades($label,$ano->ano)) )
	@endforeach
@stop