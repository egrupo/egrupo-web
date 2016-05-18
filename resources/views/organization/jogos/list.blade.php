@foreach($jogos as $jogo)
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><a href="{{ URL::route('jogos.show',[mySlug() , $jogo->id]) }}">{{ $jogo->nome }}</a></h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<pre>Duração: <strong>{{ $jogo->duracao }} minutos</strong></pre>
				</div>
				<div class="col-md-6">
					<pre>Participantes: <strong>{{ $jogo->n_participantes }} pessoas</strong></pre>
				</div>
			</div>
			<pre>Divisões: <strong>{{ App\Models\Jogo::getDivisoesFromField($jogo->divisoes) }}</strong></pre>
		</div>
	</div>
@endforeach