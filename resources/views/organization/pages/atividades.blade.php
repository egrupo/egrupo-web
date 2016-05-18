@extends('layouts.default')

@section('header')
	<title>Atividades {{ $label }} </title>
@stop

@section('content')
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			
		</div>
	</div>

	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<h3 class="text-center">{{ $ano }} <small><a href="{{ URL::route('divisoes.atividades.todas',$label) }}">(ver anos anteriores)</a></small></h3>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Nome</th>
						<th class="text-center">Data</th>
						<th class="text-center">Trimestre</th>
						<th class="text-center">Presenças</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($atividades as $atividade)
						<tr>
							<td>{{ $atividade->id }}</td>
							<td style="width:50%"><a href="{{ URL::route('atividades.show' , $atividade->id ) }}"><strong>{{ $atividade->nome }}</strong></a></td>
							<td class="text-center">{{ $atividade->performed_at }}</td>
							<td class="text-center">{{ $atividade->trimestre }}º</td>
							<td class="text-center {{ $atividade->hasPresencas()?'alert-success':'alert-warning' }}">{{ $atividade->hasPresencas()?'Sim':'Não' }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop