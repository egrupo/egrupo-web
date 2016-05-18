@extends('organization.default')

@section('header')
	<title>{{ $local->nome }}</title>
	<meta name="_token" content="{{ csrf_token() }}"/>
@stop

@section('content')
	<div class="row">
		<div class="spacer-mini"></div>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<h3>{{ $local->nome }}
						<a onclick="return confirm('Tens a certeza que queres apagar este local de arrumação?');"
							href="{{ URL::route('localarrumo.destruir',[mySlug(),$local->id]) }}">
							<span style="color: red" class="pull-right"><i class="glyphicon glyphicon-remove"></i></span>
						</a>
					</h3>
				</div>
			</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Categoria</th>
							<th class="text-center">Qtd</th>
							<th>Notas</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($local->getMaterial() as $material)
							<tr class="{{ App\Models\Material\Estado::getClass($material->estado) }}">
								<td style="width: 30%"><a href="{{ URL::route('material.edit',[mySlug(),$material->id]) }}">{{ $material->nome }}</td>
								<td style="width: 20%">{{ App\Models\Material\Categoria::getNome($material->categoria_id) }}</td>
								<td style="width: 5%" class="text-center">{{ $material->quantidade }}</td>
								<td style="width: 40%">{{ $material->notas }}</td>
								<td style="width: 5%" class="text-right"><a href="{{ URL::route('material.edit',[mySlug(),$material->id]) }}"><i class="fa fa-wrench"></i></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			@include('organization.material.material.create',['divisao' => $local->divisao,'default' => $local->id])
		</div>
	</div>
@stop

@section('scripts')
	
@stop