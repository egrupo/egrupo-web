
<div class="col-md-6">
	{!! Form::open(array('route' => array('atividades.registardescricao',mySlug(),$atividade->id), 'class' => 'form-horizontal' , 'method' => 'POST')) !!}
		<p>
			{!! Form::textarea('descricao',App\Models\RegistoAtividade::getDescricao(Auth::user()->id,$atividade->id),['class' => 'form-control', 'rows' => '13', 'placeholder' => 'o teu resumo da atividade']) !!}
		</p>
		{!! Form::button('Guardar' ,['type' => 'submit','class' => 'btn btn-large btn-primary btn-block' ]) !!}
	{!! Form::close() !!}
</div>
<div class="col-md-6">
	@if(sizeof($alterar) != 0)
		@foreach($alterar as $escoteiro)
			<pre><a href="{{ URL::route('escoteiros.show' ,[mySlug(),$escoteiro->id]) }}">{{ $escoteiro->nome }}</a>: <strong>{{ App\Models\Presenca::getLabel($escoteiro->tipo) }}</strong></pre>
		@endforeach
	@else
		
	@endif
</div>