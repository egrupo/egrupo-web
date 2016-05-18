<div class="row">
	<div class="col-md-12">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nome</th>
					<th class="text-center">Designação</th>
					<th class="text-center">Contacto</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach (App\Models\Contacto::getContactos($divisao) as $contacto)
					<tr>
						<td style="">{{ $contacto->nome }}</td>
						<td class="text-center">{{ $contacto->designacao }}</td>
						<td class="text-center">{{ $contacto->contacto }}</td>
						<td><small><a onclick="return confirm('Tens a certeza que queres apagar este Contacto?');" href="{{ URL::route('contacto.destruir',[ mySlug(), $contacto->id]) }}"><span style="color: red;" class="glyphicon glyphicon-remove"></span></a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>