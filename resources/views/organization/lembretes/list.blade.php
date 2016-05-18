<div class="row">
	<div class="col-md-12">
		<table class="table table-striped">
			<thead>
				<tr>
					<th class="text-center">Descrição</th>
					<th class="text-center">Data</th>
					<th>Autor</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach (App\Models\Lembrete::getAllLembretes($divisao) as $lembrete)
					<tr>
						<td class="text-center" style="width:50%">{{ $lembrete->label }}</td>
						<td class="text-center">{{ $lembrete->remindme_at }}</td>
						<td>{{ App\User::getNome($lembrete->user_id) }}</td>
						<td><small><a onclick="return confirm('Tens a certeza que queres apagar este lembrete?')" href="{{ URL::route('lembrete.destruir', [ myslug(), $lembrete->id] ) }}"><span style="color: red;" class="glyphicon glyphicon-remove"></span></a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>