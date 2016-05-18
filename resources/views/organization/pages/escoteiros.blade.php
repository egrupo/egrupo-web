@extends('layouts.default')

@section('header')
	<title>Escoteiros {{ $label }} </title>
@stop

@section('content')
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Nome</th>
						<th>Totem</th>
						<th>Patrulha</th>
						<th class="text-center">Etapa</th>
						<th class="text-center">Assiduidade</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($escoteiros as $escoteiro)
						<tr>
							<td>{{ $escoteiro->id_associativo }}</td>
							<td><a href="{{ URL::route('escoteiros.show' , $escoteiro->id ) }}">{{ $escoteiro->nome }}</a></td>
							<td>{{ $escoteiro->totem }}</td>
							<td>{{ $escoteiro->patrulha }}</td>
							<td class="text-center">{{ $escoteiro->getCurrentEtapa() }} ({{ $escoteiro->getCurrentPercentage($escoteiro->getCurrentEtapa()+1) }})</td>
							<td class="text-center">{{ $escoteiro->getAssiduidade() }}</td>
						</tr>
					@endforeach

				</tbody>
			</table>
		</div>
	</div>
@stop