@extends('organization.default')

@section('header')
	<title>Procurar Pessoa - {{ $term }} </title>
@stop

@section('content')
	<div class="row">
		<input type="hidden" id="query" value="{{ isset($term) ? $term : '' }}">
		<div class="col-md-12">
			<table id="table" class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Nome</th>
						<th>Totem</th>
						<th>Patrulha</th>
						<th class="text-center">Divisão</th>
					</tr>
				</thead>
				<tbody>
					<div id="results">
						@foreach ($escoteiros as $escoteiro)
							<tr>
								<td>{{ $escoteiro->id_associativo }}</td>
								<td><a href="{{ URL::route('escoteiros.show' ,[ mySlug(), $escoteiro->id] ) }}">{{ $escoteiro->nome }}</a></td>
								<td>{{ $escoteiro->totem }}</td>
								<td>{{ $escoteiro->patrulha }}</td>
								<td class="text-center">{{ App\Models\Divisao::getLabel($escoteiro->divisao) }}</td>
							</tr>
						@endforeach
					</div>
				</tbody>
			</table>
		</div>

		@if(sizeOf($escoteiros) == 0)
		<div class="row">
			<div class="col-md-12">
				
				<div class="col-md-offset-1 col-md-10 alert alert-warning">
					<div class="col-md-6">
						<br />
						<p>Não foram encontrados resultados para a pesquisa: <strong>{{ isset($term) ? $term : '' }}</strong> <br />
						Os parâmetros incluídos na pesquisa são:</p>
						<ul>
							<li>Número associativo</li>
							<li>Nome</li>
							<li>Totem</li>
							<li>Patrulha</li>
						</ul>
					</div>

					<div class="col-md-6">
						<br />
						<br />
						<h1 class="text-center">¯\_(ツ)_/¯</h1>
					</div>
					
				</div>
			</div>
		</div>
		@endif
		
	</div>
@stop

@section('scripts')
	{!! Html::script('js/plugins/jquery.highlight.js') !!}
	<script>
		$(document).ready(function(){
			var text = $('#query').val();
			console.log(text);
			$('td').highlight(text);
		});
	</script>
@stop