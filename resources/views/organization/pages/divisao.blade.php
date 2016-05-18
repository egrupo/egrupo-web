@extends('organization.default')

@section('header')
	<title>{{ App\Models\Divisao::getLabel($divisao) }} </title>
	{!! Html::script('js/divisao.js') !!}
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css" >
@stop

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h1 clasS="page-header">{{ App\Models\Divisao::getName($divisao) }}</h1>
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Contactos <i data-toggle="tooltip" data-placement="bottom" title="Estes contactos são destinados tanto à chefia da divisão(aparecem listados em baixo) como aos elementos de uma divisão(aparece na página inicial de cada um)" class="pull-right glyphicon glyphicon-question-sign"></i>
						</h4>

				</div>
				<div class="panel-body">
					@include('organization.contactos.list',['divisao' => $divisao])
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Avisos <i data-toggle="tooltip" title="Os avisos são destinados aos elementos da divisão. Uma vez criados são mostrados nas suas páginas consoante seja destinado a um só elemento ou à divisão toda." class="pull-right glyphicon glyphicon-question-sign"></i>
						</h4>
				</div>
				<div class="panel-body">
					@include('organization.avisos.list',['divisao' => $divisao])
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Ordens de Serviço <small><a href="{{ URL::route('divisoes.os.todas',[ mySlug(), App\Models\Divisao::getLabel($divisao) ] ) }}">(ver anos anteriores)</a></small>
						<!-- <i data-toggle="tooltip" title="!!" class="pull-right glyphicon glyphicon-question-sign"></i> -->
					</h4>
				</div>
				<div class="panel-body">
					@include('organization.os.list',['divisao' => $divisao])
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Lembretes <i data-toggle="tooltip" title="Os lembretes são destinados à própria Chefia da divisão. Estes aparecem na página inicial do grupo. Dica: Para criar um lembrete que apareça imediatamente basta criar com a data de hoje!" class="pull-right glyphicon glyphicon-question-sign"></i>
						</h4>
				</div>
				<div class="panel-body">
					@include('organization.lembretes.list',['divisao' => $divisao])
				</div>
			</div>
			
		</div>
		<div class="col-md-4">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				@include('organization.escoteiros.create',['divisao' => $divisao, 'accordion' => true])
				@include('organization.atividades.create',['divisao' => $divisao, 'accordion' => true])
				@include('organization.os.create',['divisao' => $divisao ])
		 		@include('organization.lembretes.create',['divisao' => $divisao ])
				@include('organization.avisos.create',['divisao' => $divisao ])
				@include('organization.contactos.create',['divisao' => $divisao ])
				@include('organization.progresso.gravar_bulk',['divisao' => $divisao ])
			</div>
			<!-- <a href="{{ route('divisoes.progresso',[mySlug(),$divisao]) }}" class="btn btn-large btn-primary">Gerar Tabela de Progresso</a> -->
	</div>

@stop

@section('scripts')
	<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
	    	$('[data-toggle="tooltip"]').tooltip(); 
	    	$('#osTable').DataTable({
	    		ordering: false,
	    		searching: false,
	    		info: false,
	    		lengthChange: false,
	    	});
		});
	</script>
@stop