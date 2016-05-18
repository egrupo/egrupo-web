@foreach($especialidades as $especialidade)
	<div name="#{{ $especialidade->id }}" class="panel-group">
		<div class="panel panel-primary">
			<div class="panel-heading"><h3 class="panel-title">{{ $especialidade->label }}</h3></div>
			<div class="panel-body">
				@foreach(App\Models\Especialidade::getDesafiosEspecialidade($especialidade->id) as $prova)
					<div class="panel panel-default">
						<div class="panel-heading">
							<strong>{{ $prova->titulo }}</strong>
						</div>
						<div class="panel-body">
							{{ $prova->descricao }}
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endforeach