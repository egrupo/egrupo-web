@extends('organization.default')

@section('header')
	<title>Auxiliar do PNEC</title>
@stop

@section('content')
	<div class="row">
		<h3 class="header text-center page-header">Gerar lista nominal para o PNEC</h3>
		{!! Form::open() !!}
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12 btn-group" data-toggle="buttons">
					<label data-divisao="Alcateia" class="b-divisao btn-large-div1 btn btn-warning">Alcateia</label>
					<label data-divisao="TEs" class="b-divisao btn-large-div2 btn btn-large btn-success">Tribo de Escoteiros</label>
					<label data-divisao="TEx" class="b-divisao btn-large-div3 btn btn-primary">Tribo de Exploradores</label>
					<label data-divisao="Cla" class="b-divisao btn-large-div4 btn btn-danger">Clã</label>
					<label data-divisao="Chefia" class="b-divisao btn-large-div5 btn btn-default">Chefia</label>
					</div>
				</div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th></th>
						<th>Nº Associativo</th>
						<th>Nome Completo</th>
						<th>Divisão</th>
					</tr>
				</thead>
				<tbody>
					@foreach(App\Models\Escoteiro::getAll() as $e)
						<tr class="elem-row">
							<td>{!! Form::checkbox('id[]', $e->id_associativo) !!}</td>
							<td>{{ $e->id_associativo }}</td>
							<td>{{ $e->nome_completo }}</td>
							<td>{{ App\Models\Divisao::getLabel($e->divisao) }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-4">
			<h3>Entidade</h3>
			<p>{!! Form::text('entidade','AEP',array('class' => 'form-control', 'placeholder' => 'Entidade','required' )) !!}</p>
			<p>{!! Form::text('grupo',Auth::user()->organization->number,array('class' => 'form-control', 'placeholder' => 'Grupo','required' => 'required' )) !!}</p>
			<p>{!! Form::text('regiao',null,array('class' => 'form-control', 'placeholder' => 'Região','required' => 'required' )) !!}</p>
			<p>{!! Form::text('contacto',myslug().'@escoteiros.pt',array('class' => 'form-control', 'placeholder' => 'Contacto','required' => 'required' )) !!}</p>
			<h3>Dirigente Responsável</h3>
			<p>{!! Form::text('nome',Auth::user()->name,array('class' => 'form-control', 'placeholder' => 'Nome','required' => 'required' )) !!}</p>
			<p>{!! Form::text('cargo',null,array('class' => 'form-control', 'placeholder' => 'Cargo','required' => 'required' )) !!}</p>
			<p>{!! Form::text('nassociativo',Auth::user()->escoteiro_id,array('class' => 'form-control', 'placeholder' => 'Número Associativo','required' => 'required' )) !!}</p>
			<p>{!! Form::text('telemovel',null,array('class' => 'form-control', 'placeholder' => 'Telemóvel','required' => 'required' )) !!}</p>
			<h3>Atividade</h3>
			<p>Data de Início: {!! Form::date('data_inicio',null,array('class' => 'form-control','required' => 'required' )) !!}</p>
			<p>Data de Fim: {!! Form::date('data_fim',null,array('class' => 'form-control', 'required' => 'required' )) !!}</p>
			<h3>Enviar por email? {!! Form::checkbox('enviaremail', 1,null,['id' => 'enviaremail']) !!}</h3>
			<p>{!! Form::textarea('intro',null,array('class' => 'form-control','rows' => '4' ,'placeholder' => 'Corpo do email' )) !!}</p>
			<p>{!! Form::email('email',null,array('class' => 'form-control', 'placeholder' => 'Email para enviar a lista' )) !!}</p>
			<p><button class="btn btn-large btn-primary btn-block" id="botao" type="submit">Download</button></p>
		</div>
		{!! Form::close() !!}
	</div>
@stop

@section('scripts')
	{!! Html::script('js/geral.js') !!}
	<script>
		$('.b-divisao').on('click',function(){
			var divisao = $(this).data('divisao');
			
			if($(this).hasClass('active')){
				//deselect all
				$('.elem-row').each(function(index){
					if(divisao == $(this).children(':nth-child(4)').html()){
						$(this).children(':nth-child(1)').children(':nth-child(1)').prop('checked',false);
					}
				});
			} else {
				//select all
				$('.elem-row').each(function(index){
					if(divisao == $(this).children(':nth-child(4)').html()){
						$(this).children(':nth-child(1)').children(':nth-child(1)').prop('checked',true);
					}
				});
			}
		});
	</script>
@stop