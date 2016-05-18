<div class="row">
	<div class="col-md-12">
		<h3 class="text-center">{{ $ano }}</h3>
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
						<td style="width:50%"><a href="{{ URL::route('atividades.show' ,[ mySlug(), $atividade->id ] ) }}"><strong>{{ $atividade->nome }}</strong></a></td>
						<td class="text-center">{{ $atividade->performed_at }}</td>
						<td class="text-center">{{ $atividade->trimestre }}º</td>
						<td class="text-center {{ $atividade->hasPresencas()?'alert-success':'alert-warning' }}">{{ $atividade->hasPresencas()?'Sim':'Não' }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>