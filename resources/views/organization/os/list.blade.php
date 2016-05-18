<div class="row">
	<div class="col-md-12">
		<table id="osTable" class="table table-striped">
			<thead>
				<tr>
					<th>Nome/Atividade</th>
					<th class="text-center">Descrição</th>
					<th class="text-center">Data</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach (App\Models\OS::listOS($divisao) as $os)
					<tr>
						<td style="width:25%"><a href="
							@if($os->type_id == 0)
								{{ URL::route('atividades.show' , [ mySlug() , $os->escoteiro_id ]) }}	
							@else
								{{ URL::route('escoteiros.show' , [ mySlug() , $os->escoteiro_id ]) }}
							@endif
							">{{ $os->nome }}</a></td>
						<td class="text-center" style="width:50%">{{ $os->label }}</td>
						<td class="text-center">{{ $os->data }}</td>
						<td><small><a onclick="return confirm('Tens a certeza que queres apagar esta Ordem de Serviço?');" href="{{ URL::route('os.destruir', [mySlug() , $os->id ] ) }}"><span style="color: red;" class="glyphicon glyphicon-remove"></span></a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>