@extends('organization.default')

@section('header')
	<title>Atividades {{ $label }} </title>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h3 class="text-center">{{ $ano }} <small><a href="{{ URL::route('divisoes.atividades.todas',[ mySlug(), $label]) }}">(ver anos anteriores)</a></small></h3>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Nome</th>
						<th class="text-center">Data</th>
						<th class="text-center">Trimestre</th>
						<th class="text-center">Presenças</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($atividades as $atividade)
						<tr>
							<td style="width:50%"><a href="{{ URL::route('atividades.show' , [mySlug(), $atividade->id] ) }}"><strong>{{ $atividade->nome }}</strong></a></td>
							<td class="text-center">{{ $atividade->performed_at }}</td>
							<td class="text-center">{{ $atividade->trimestre }}º</td>
							<td class="text-center {{ $atividade->hasPresencas()?'alert-success':'alert-warning' }}">{{ $atividade->hasPresencas()?'Sim':'Não' }}</td>
						</tr>
					@endforeach

					@if(sizeOf($atividades) == 0)
						<tr>
							<td style="width:50%"><i>Atividade Exemplo 1</i></td>
							<td class="text-center"><i>2016-02-06</i></td>
							<td class="text-center"><i>2º</i></td>
							<td class="text-center alert-success"><i>Sim</i></td>
						</tr>

						<tr>
							<td style="width:50%"><i>Atividade Exemplo 2</i></td>
							<td class="text-center"><i>2016-02-13</i></td>
							<td class="text-center"><i>2º</i></td>
							<td class="text-center alert-warning"><i>Não</i></td>
						</tr>

						<tr>
							<td style="width:50%"><i>Atividade Exemplo 3</i></td>
							<td class="text-center"><i>2016-02-20</i></td>
							<td class="text-center"><i>2º</i></td>
							<td class="text-center alert-warning"><i>Não</i></td>
						</tr>
					@endif
				</tbody>
			</table>

			<div class="spacer"></div>
			<div class="row">
				<div class="well col-md-5">
					@if(sizeOf($atividades) == 0)
						<h4>Informação</h4>
						<p class="">Parece que ainda não inseriste nenhuma atividade nesta divisão.</p>
						<p class="">Depois de inserires uma atividade, és redirecionado(a) para a ficha da mesma.</p>
						<p class="">Depois podes voltar aqui para inserir mais ou então no menu 'Divisão'.</p>
					@else
						<h4>Informação</h4>
						<p class="">A coluna presenças indica se já foram inseridas presenças na atividade em questão. Basta ter uma presença inserida para o egrupo indicar 'Sim'.</p>
						<p class="">Todos os elementos que deveriam participar na atividade devem ter 'Presença' ou 'Falta'.</p>
					@endif
				</div>
				<div class="col-md-7">
					@include('organization.atividades.create',['divisao' => $divisao, 'accordion' => false ])
				</div>
			</div>
		</div>
	</div>
@stop