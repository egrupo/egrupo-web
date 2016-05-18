<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Criar Pequeno Grupo</h3>
	</div>
	<div class="panel-body">
		{!! Form::open(array('route' => ['pequenogrupo.store',mySlug()],'class' => 'form-horizontal' )) !!}
		 	
			<div class="form-group">
				<label for="nome" class="col-md-3 control-label">Nome</label>
			    <div class="col-md-9">
			    	<input type="text" name="nome" class="form-control" id="nome" placeholder="Ex: Raposa, Bando Ruivo" required>
			    </div>
			</div>

			<div class="form-group">
				<label for="divisao" class="col-md-3 control-label">Divisão</label>
				<div class="col-md-9">
					<select class="form-control" name="divisao">
						<option value="1">Alcateia</value>
						<option value="2">Tribo de Escoteiros</value>
						<option value="3">Tribo de Exploradores</value>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-3 col-md-4">
				    <button type="submit" class="btn btn-default">Criar Pequeno Grupo</button>
			    </div>
			</div>
		{!! Form::close() !!}
	</div>
</div>