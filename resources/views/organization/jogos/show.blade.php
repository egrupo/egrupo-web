@extends('organization.default')

@section('header')
	<title>{{ $jogo->nome }}</title>
@stop

@section('content')
	<div class="row">
		<h2 class="page-header">{{ $jogo->nome }} <small><a href="{{ URL::route('jogos.edit',[ mySlug() , $jogo->id ] ) }}"><span class="glyphicon glyphicon-edit"></span></a></small></h2>
		<div class="col-md-5">
			<pre>Duração: <strong>{{ $jogo->duracao }} minutos</strong></pre>
			<pre>Participantes: <strong>{{ $jogo->n_participantes }} pessoas</strong></pre>
			<pre>Divisões: <strong>{{ App\Models\Jogo::getDivisoesFromField($jogo->divisoes) }}</strong></pre>
		</div>
		<div class="col-md-7">
			<pre><strong>{{ $jogo->descricao }}</strong> </pre>
		</div>
	</div>

@stop