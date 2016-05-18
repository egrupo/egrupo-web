 <div class="row">
	<!-- Desenhar o progresso desta divisão(para dividir dos input) -->
	@if($divisao != App\User::$CHEFIA)
		@for($j = 1 ; $j < 4 ; $j++)
			<div class="col-md-4">
				<pre>{{ App\Models\Etapa::getLabel($j,$divisao) }}: <strong>{{ $escoteiro->concludedEtapa($j,$divisao) }}</strong></pre>
					<div class="row">
						<div style="padding-left: 15px; padding-right: 15px">
							@for($i = 1 ; $i < App\Models\Etapa::getNProvas($j,$divisao)+1 ; $i++)
								<a class="prova {{ $escoteiro->concludedProva($j,$divisao,$i)?'prova-done':'prova-undone' }}" tabindex="0" data-container="body" 
											data-toggle="popover" data-trigger="focus" 
											data-placement="bottom" title="{{ 'Prova: '.$i }}" 
											data-content="{{ $escoteiro->concludedProva($j,$divisao,$i) }}"
											data-prova="{{ $i }}"
											data-escoteiro-id="{{ $escoteiro->id }}"
											data-divisao="{{ $divisao }}"
											data-etapa="{{ $j }}"
											>
											@if($i > 9)
												<span style="color: black; margin-left: 2px">{{ $i }}</span>
											@else
												<span style="color: black; margin-left: 6px">{{ $i }}</span>
											@endif
								</a>
							@endfor
						</div>
					</div>
			</div>
		@endfor
	@else
	<!-- Desenhar para a chefia -->
	@endif
</div>