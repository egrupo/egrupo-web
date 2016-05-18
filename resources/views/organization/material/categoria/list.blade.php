<div class="panel panel-default">
	<div class="panel-heading"><h4>Lista de Categorias</h4></div>
	<div class="panel-body">
		<table class="table table-hover table-borderless">
			<tbody>
				@foreach(App\Models\Material\Categoria::all() as $cat)
					<tr>
						<td>{{ $cat->nome }}</td>
						<td class="pull-right">
							<a onclick="return confirm('Tens a certeza que queres apagar esta categoria?');"
								style="color: red" href="{{ URL::route('categoria.destruir',[mySlug(), $cat->id]) }}"><i class="glyphicon glyphicon-remove"></i></a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>