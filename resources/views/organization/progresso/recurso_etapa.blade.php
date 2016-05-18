@foreach($caderno as $desafio3)
	<div class="panel {{ Auth::user()->tirouProva($desafio3->divisao,$desafio3->etapa,$desafio3->id) ? 'panel-success' : 'panel-default' }}">
		<div class="panel-heading"><h3 class="panel-title">{{ $desafio3->id }}</h3></div>
		<div class="panel-body">
			<strong>{{ $desafio3-> titulo }}</strong>
			@if($desafio3->titulo == '')
			@else
    			<p>
    				<small>{{ $desafio3-> descricao }}</small>
    			</p>
    		@endif
		</div>
	</div>
@endforeach