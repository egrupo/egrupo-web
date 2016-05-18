<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Criar Local de Arrumação</h3>
	</div>
	<div class="panel-body">
		{!! Form::open(array('route' => ['localarrumo.store',mySlug()],'class' => 'form-horizontal' )) !!}
		 	
			<div class="form-group">
				<label for="nome" class="col-md-3 control-label">Nome</label>
			    <div class="col-md-9">
			    	<input type="text" name="nome" class="form-control" id="nome" placeholder="Ex: Zona1, Zona2, Armário Entrada" required>
			    </div>
			</div>

			<input type="hidden" name="divisao" value="{{ $divisao }}" />

			<div class="form-group">
				<div class="col-md-offset-3 col-md-4">
				    <button type="submit" class="btn btn-default">Criar Local de Arrumação</button>
			    </div>
			</div>
		{!! Form::close() !!}
	</div>
</div>