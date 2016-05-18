@extends('organization.default')

@section('header')
	<title>Auxiliar do Cartão Escoteiro</title>
@stop

@section('content')
	<div class="row">
		{!! Form::open() !!}
		<h3 class="header text-center page-header">Gerar lista para Cartão do Escoteiro</h3>
		<div class="col-md-8">
			<table class="table table-striped">
				<thead>
					<tr>
						<th></th>
						<th>Nº Associativo</th>
						<th>Nome Completo</th>
						<th>1º Cartão? <i data-toggle="tooltip" data-placement="bottom" title="Deixar preenchido se for a primeira vez que este escoteiro pede o cartão de escoteiro" class="pointer glyphicon glyphicon-question-sign"></i></th>
						<th>Divisão</th>
					</tr>
				</thead>
				<tbody>
					@foreach(App\Models\Escoteiro::getAll() as $e)
						<tr>
							<td>{!! Form::checkbox('id[]', $e->id_associativo) !!}</td>
							<td>{{ $e->id_associativo }}</td>
							<td>{{ $e->nome_completo }}</td>
							<td class="text-center">{!! Form::checkbox('cartao[]',$e->id,true) !!}</td>
							<td>{{ App\Models\Divisao::getLabel($e->divisao) }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-4">

			<h4>Enviar por email? {!! Form::checkbox('enviaremail', 1,null,['id' => 'enviaremail']) !!}</h4>
			<p>{!! Form::textarea('intro',null,array('class' => 'form-control','rows' => '4' ,'placeholder' => 'Corpo do email' )) !!}</p>
			<p>{!! Form::email('email',null,array('class' => 'form-control', 'placeholder' => 'Email a enviar a lista' )) !!}</p>
			<p><button class="btn btn-large btn-primary btn-block" id="botao" type="submit">Download</button></p>
			
		</div>
		{!! Form::close() !!}
	</div>	
@stop

@section('scripts')
	{!! Html::script('js/geral.js') !!}
@stop