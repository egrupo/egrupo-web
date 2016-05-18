@extends('organization.newdefault')

@section('header')
	<title>Dashboard - {{ Auth::user()->name }} </title>
	{!! Html::script('js/Chart.min.js') !!}
	{!! Html::script('js/dashboard.js') !!}
@stop

@section('content')
	<div class="row">
		<h4 class="">{{ $greeting }}, {{ $escoteiro->nome }}</h4>
		<div class="col-md-5">
			<h4 class="">Avisos</h4>
			@foreach($avisos_escoteiro as $aviso)
				<pre>{{ $aviso->descricao }}</pre>
			@endforeach

			<h4 class="page-header">Avisos {{ App\Models\Divisao::getLabel($escoteiro->divisao) }}</h4>
			@foreach($avisos_divisao as $aviso_divisao)
				<pre>{{ $aviso_divisao->descricao }}</pre>
			@endforeach

			<h4 class="page-header">Contactos</h4>
			@foreach(App\Models\Contacto::where('organization_id',Auth::user()->organization_id)->where('divisao',$escoteiro->divisao)->get() as $contacto)
				<pre>{{ $contacto->nome }} - {{ $contacto->contacto }}</pre>
			@endforeach
		</div>
		<div class="col-md-7">
			<h4 class="">Calendário</h4>
			<div> 
				@include('organization.calendario.show', array('divisao' => $escoteiro->divisao))
			</div>
			
			<div style="clear: both;">
				<h4 class="page-header">Próxima Atividade: @if($prox_atividade)<strong><a href="{{ URL::route('atividades.show' , [mySlug(),$prox_atividade->id] ) }}">{{ $prox_atividade->nome }}</a></strong>@endif</h4>
				@if($prox_atividade)
					<pre>{{ $prox_atividade->infos }}</pre>
				@endif
			</div>
		</div>
	</div>
@stop