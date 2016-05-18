
<div class="col-md-6">
	@if(sizeof($marcar)!=0) 
		<p><a href="{{ URL::route('atividades.marcarpresencas',[mySlug() , $atividade->id , $presencas_divisao ] ) }}">
			<button type="button" class="btn btn-large btn-primary btn-block">Marcar Presenças</button>
		</a></p>
		@foreach($marcar as $escoteiro)
			<pre><a href="{{ URL::route('escoteiros.show' ,[mySlug(), $escoteiro->id]) }}">{{ $escoteiro->nome }}</a> por marcar</pre>
		@endforeach
	@else
		
	@endif
</div>
<div class="col-md-6">
	@if(sizeof($alterar) != 0)
		<p><a href="{{ URL::route('atividades.alterarpresencas',[mySlug(),$atividade->id]) }}">
			<button type="button" class="btn btn-large btn-danger btn-block">Alterar Presenças</button>
		</a></p>
		@foreach($alterar as $escoteiro)
			<pre><a href="{{ URL::route('escoteiros.show' ,[mySlug(),$escoteiro->id]) }}">{{ $escoteiro->nome }}</a>: <strong>{{ App\Models\Presenca::getLabel($escoteiro->tipo) }}</strong></pre>
		@endforeach
	@else
		
	@endif
</div>