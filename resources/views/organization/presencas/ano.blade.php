<div class="row">
	@for($i = 1 ; $i < 4 ; $i++)
		<div class="col-md-4 text-center">
			<h5>{{ $i }}º Trimestre</h5>
			@foreach($escoteiro->getPresencas($i,$ano) as $presenca)
				<pre style="background-color: {{ $presenca->tipo == 1? '#dff0d8' : '#e7c3c3 ' }}"><a href="{{ URL::route('atividades.show' ,[mySlug(),$presenca->atividade_id]) }}" >{{ $presenca->nome }}</a> - {{ $presenca->performed_at }}</pre>
			@endforeach
		</div>
	@endfor
</div>