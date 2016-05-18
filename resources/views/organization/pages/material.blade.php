@extends('organization.default')

@section('header')
	<title>Material {{ $label }} </title>
@stop

@section('content')

	<div class="row">
		@if(!$short_view)
			<div class="col-md-8">
				<h3 class="page-header text-center">Locais de Arrumação</h3>
				<div id="container" class="js-masonry" data-masonry-options='{ "columnWidth": 315, "itemSelector": ".local-arrumo" }'>
					@foreach($locais as $local)
						<div class="local-arrumo panel panel-primary" style="width: 47.5%">
							<div class="panel-heading"><div class="panel-title"><a href="{{ URL::route('localarrumo.show',[mySlug(),$local->id]) }}">{{ $local->nome }}</a></div></div>
							<div class="panel-body">
								<table class="table">
									<thead>
										<tr>
											<th>Nome</th>
											<th class="text-right">Qtd.</th>
										</tr>
									</thead>
									<tbody>
										@foreach($local->getMaterial() as $material)
											<tr class="{{ App\Models\Material\Estado::getClass($material->estado) }}">
												<td><a href="{{ URL::route('material.edit',[mySlug(),$material->id]) }}">{{ $material->nome }}</a></td>
												<td class="text-right">{{ $material->quantidade }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					@endforeach
				</div>
			</div>
			<div class="col-md-4">
				<h3 class="page-header text-center">Gerir Material</h3>
				@include('organization.material.material.create',['divisao' => $divisao,'default' => 0])
				@include('organization.material.localarrumo.create',['divisao' => $divisao])
				<div class="panel panel-default material-update">
					<div class="panel-heading"><i class="fa fa-refresh fa-fw"></i> Últimas Atualizações</div>
					<div class="panel-body">
						@foreach($locais->sortByDesc('last_update_at') as $local)
							<div class="material-update-item">
								<p>
									<strong class="primary-font">{{ $local->nome }}</strong><br />
									<small class="text-muted">
										<i class="fa fa-clock-o fa-fw"></i>
										{{ \Carbon\Carbon::createFromTimeStamp(strtotime($local->last_update_at))->diffForHumans() }}
										por {{ App\User::getNome($local->user_id) }}
									</small>
								</p>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<h3 class="page-header text-center">Por Categoria</h3>
				<table class="table">
					<thead>
						<th>Nome</th>
						<th>Categoria</th>
						<th>Qtd.</th>
						<th>Local</th>
						<th></th>
					</thead>
					<tbody>
						@foreach(App\Models\Material\Categoria::getMaterialOrderByCategoria($divisao) as $mat)
							<tr class="{{ App\Models\Material\Estado::getClass($mat->estado) }}">
								<td><a href="{{ URL::route('material.edit',[mySlug(),$mat->id]) }}">{{ $mat->nome }}</a></td>
								<td>{{ App\Models\Material\Categoria::getNome($mat->categoria_id) }}</td>
								<td>{{ $mat->quantidade }}</td>
								<td><a href="{{ URL::route('localarrumo.show',[mySlug(),$mat->local_arrumo]) }}">{{ App\Models\Material\LocalArrumo::getNome($mat->local_arrumo) }}</a></td>
								<td>
									<a onclick="return confirm('Tens a certeza que queres apagar este material?');"
										style="color: red" href="{{ URL::route('material.destruir',[mySlug(), $mat->id]) }}"><i class="glyphicon glyphicon-remove"></i></a>
								</td>
							</tr>
						@endforeach
				</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h3 class="page-header text-center">Gerir Categorias</h3>
				@include('organization.material.categoria.create')
				@include('organization.material.categoria.list')
			</div>
		@else
			<h3 class="text-center page-header">Material</h3>
			<div class="col-md-offset-1 col-md-5">
				<div class="panel panel-info">
					<div class="panel-heading">Locais de Arrumação</div>
					<div class="panel-body">
						<p>Parece que ainda não criaste nenhum local de arrumação para esta divisão.</p>
						<p>Locais de arrumação são zonas em que guardas o material. Podem ser caixas de arruamção, divisões da tua sede ou armários específicos, fica ao teu critério.</p>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				@include('organization.material.localarrumo.create',['divisao' => $divisao])
			</div>
		@endif
	</div>
@stop

@section('scripts')
	<script type="text/javascript" src="{{ URL::asset('js/masonry.pkgd.min.js') }}"></script>
	<!--
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
		$(function() {
		    $('#sortable').sortable({
		        start: function(event, ui) {
		        	console.log('started: '+ui.item.index());
		            var start_pos = ui.item.index();
		            ui.item.data('start_pos', start_pos);
		        },
		        change: function(event, ui) {
		        	console.log('change: '+ui.item.index());
		            var start_pos = ui.item.data('start_pos');
		            var index = ui.placeholder.index();
		            if (start_pos < index) {
		                $('#sortable div:nth-child(' + index + ')').addClass('highlights');
		            } else {
		                $('#sortable div:eq(' + (index + 1) + ')').addClass('highlights');
		            }
		        },
		        update: function(event, ui) {
		        	console.log('update: '+ui.item.index());
		            $('#sortable div').removeClass('highlights');
		        }
		    });
		});
	  </script>
		-->
@stop