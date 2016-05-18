<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Criar Material</h3>
	</div>
	<div class="panel-body">
		{!! Form::open(array('route' => ['material.store',mySlug()],'class' => 'form-horizontal' )) !!}
		 	
			<div class="form-group">
				<label for="nome" class="col-md-3 control-label">Nome</label>
			    <div class="col-md-9">
			    	<input type="text" name="nome" class="form-control" id="nome" placeholder="Tenda" required>
			    </div>
			</div>

			<input type="hidden" name="divisao" value="{{ $divisao }}" />

			<div class="form-group">
				<label for="quantidade" class="col-md-4 control-label">Quantidade</label>
				<div class="col-md-8">
					<input type="number" name="quantidade" class="form-control" id="quantidade" placeholder="37" required>
				</div>
			</div>

			<div class="form-group">
				<label for="local_arrumo" class="col-md-3 control-label">Local</label>
				<div class="col-md-9">
					<select class="form-control" name="local_arrumo">
						@foreach(App\Models\Material\LocalArrumo::getLocaisArrumo($divisao) as $local)
							<option value="{{ $local->id }}" @if($default && $local->id == $default) selected @endif>{{ $local->nome }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-offset-3 col-md-4">
				    <button type="submit" class="btn btn-default">Criar Material</button>
			    </div>
			</div>
		{!! Form::close() !!}
	</div>
</div>