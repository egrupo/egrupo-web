<div class="row">
	<div class="col-md-12">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Para</th>
					<th class="text-center">Aviso</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach (App\Models\Aviso::getAvisos($divisao) as $aviso)
					<tr>
						<td style="">
							@if($aviso->tipo == App\Models\Aviso::$GRUPO)
								{{ App\Models\Divisao::getLabel($aviso->target_id) }}
							@else
								{{ App\Models\Escoteiro::where('id',$aviso->target_id)->pluck('nome') }}
							@endif
						</td>
						<td class="text-center">{{ $aviso->descricao }}</td>
						<td><small><a onclick="return confirm('Tens a certeza que queres apagar este Aviso?');" href="{{ URL::route('aviso.destruir', [ mySlug() , $aviso->id ] ) }}"><span style="color: red;" class="glyphicon glyphicon-remove"></span></a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>