<div class="row">
	<div id="container" class="js-masonry" data-masonry-options='{ "columnWidth": 240, "itemSelector": ".item-especialidade" }'>
		@foreach(App\Models\Especialidade::getEspecialidades($divisao) as $esp)
			<div class="item-especialidade panel {{ $escoteiro->concludedEspecialidade($esp->id)?'panel-success':'panel-danger' }}" >
				<div class="panel-heading">
					{{ $esp->label }}
				</div>
				<div class="panel-body">
					@for($i = 1 ; $i < App\Models\Especialidade::getNDesafiosEspecialidade($esp->id)+1 ; $i++)
						<a class="provaespecialidade {{ $escoteiro->concludedProvaEspecialidade($esp->id,$i)?'prova-done':'prova-undone' }}" tabindex="0" data-container="body" 
									data-toggle="popover" data-trigger="focus" 
									data-placement="bottom" title="{{ 'Prova: '.$i }}" 
									data-content="{{ $escoteiro->concludedProvaEspecialidade($esp->id,$i) }}"
									data-prova="{{ $i }}"
									data-escoteiro-id="{{ $escoteiro->id }}"
									data-especialidade="{{ $esp->id }}">
						</a>
					@endfor
				</div>
			</div>
		@endforeach
	</div>
</div>