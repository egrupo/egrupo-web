@extends('organization.default')

@section('header')
	<title>Escoteiros</title>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped">
				<thead>
					<tr>
						<th class="">#</th>
						<th>Nome</th>
						<th>Totem</th>
						<th>{{ $divisao == \App\Models\Divisao::$ALCATEIA ? 'Bando':'Patrulha'}}</th>
						<th class="text-center">Etapa</th>
						<th class="text-center">Assiduidade</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($escoteiros as $escoteiro)
						<tr>
							<td class="">{{ $escoteiro->id_associativo }}</td>
							<td><a href="{{ URL::route('escoteiros.show' , [ mySlug() , $escoteiro->id] ) }}">{{ $escoteiro->nome }}</a></td>
							<td>{{ $escoteiro->totem }}</td>
							<td>{{ $escoteiro->patrulha }}</td>
							<td class="text-center">{{ $escoteiro->getCurrentEtapa() }} ({{ $escoteiro->getCurrentPercentage($escoteiro->getCurrentEtapa()+1) }})</td>
							<td class="text-center">{{ $escoteiro->getAssiduidade() }}</td>
						</tr>
					@endforeach

					@if(sizeOf($escoteiros) == 0)
						<tr class="warning">
							<td><i>99997</i></td>
							<td><i>Escoteiro Exemplo 1</i></td>
							<td><i>Corvo</i></i></td>
							<td><i>Raposa</i></td>
							<td class="text-center"><i>3</i></td>
							<td class="text-center"><i>100%</i></td>
						</tr>

						<tr class="warning">
							<td><i>99998</i></td>
							<td><i>Escoteiro Exemplo 2</i></td>
							<td><i>Formiga</i></i></td>
							<td><i>Raposa</i></td>
							<td class="text-center"><i>3</i></td>
							<td class="text-center"><i>100%</i></td>
						</tr>

						<tr class="warning">
							<td><i>99999</i></td>
							<td><i>Escoteiro Exemplo 3</i></td>
							<td><i>Lebre</i></i></td>
							<td><i>Urso</i></td>
							<td class="text-center"><i>3</i></td>
							<td class="text-center"><i>100%</i></td>
						</tr>
					@endif
				</tbody>
			</table>

			<div class="spacer"></div>
			<div class="row">
				<div class="well col-md-5">
					@if(sizeOf($escoteiros) == 0)
						<h4>Informação</h4>
						<p class="">Parece que ainda não inseriste ninguém nesta divisão. Preenche o número associativo e o nome ao lado.</p>
						<p class="">Depois de inserires um elemento, és redirecionado(a) para o perfil do mesmo.</p>
						<p class="">Depois podes voltar aqui para inserir mais ou então no menu 'Divisão'.</p>
					@else
						<h4>Informação</h4>
						<p class="">Depois de inserires um elemento, és redirecionado(a) para o perfil do mesmo.</p>
						<p class="">Depois podes voltar aqui para inserir mais ou então no menu 'Divisão'.</p>
					@endif
				</div>
				<div class="col-md-7">
					@include('organization.escoteiros.create',['divisao' => $divisao, 'accordion' => false])
				</div>
			</div>
			
		</div>
	</div>
@stop