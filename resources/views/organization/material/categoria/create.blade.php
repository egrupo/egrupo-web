<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Criar Categoria</h3>
	</div>
	<div class="panel-body">
		{!! Form::open(array('route' => ['categoria.store',mySlug()],'class' => 'form-horizontal' )) !!}
		 	
			<div class="form-group">
				<label for="nome" class="col-md-3 control-label">Nome</label>
			    <div class="col-md-9">
			    	<input type="text" name="nome" class="form-control" id="nome" placeholder="Ex: Escritório, Campo, Comida" required>
			    </div>
			</div>

			<div class="form-group">
				<div class="col-md-offset-3 col-md-4">
				    <button type="submit" class="btn btn-default">Criar Categoria</button>
			    </div>
			</div>
		{!! Form::close() !!}
	</div>
</div>