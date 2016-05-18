<div class="panel panel-default">
	<div class="panel-heading mpanel-head cursor-default" data-toggle="collapse" data-parent="#accordion" href="#cContacto" aria-expanded="false" aria-controls="cContacto">
		<h3 class="panel-title">Criar Contacto<span class="pull-right glyphicon glyphicon-collapse-down"></span></h3>
	</div>
	<div id="cContacto" class="panel-collapse collapse" role="tabpanel" aria-labelledby="cContacto">
		<div class="panel-body mpanel-body">
			{!! Form::open(array('route' => ['contactos.store' , mySlug() ],'class' => 'form-horizontal' )) !!}
				<div class="form-group">
					<label for="nome" class="col-md-3 control-label">Nome</label>
				    <div class="col-md-9">
				    	<input type="text" name="nome" class="form-control" id="nome" placeholder="Inês Leal">
				    </div>
				</div>
				<div class="form-group">
					<label for="designacao" class="col-md-3 control-label">Designação</label>
				    <div class="col-md-9">
				    	<input type="text" name="designacao" class="form-control" id="designacao" placeholder="Escoteira Chefe de Grupo">
				    </div>
				</div>
				<div class="form-group">
					<label for="contacto" class="col-md-3 control-label">Contacto</label>
				    <div class="col-md-9">
				    	<input type="text" name="contacto" class="form-control" id="contacto" placeholder="966 666 666">
				    </div>
				</div>
				
				<div class="form-group">
					<div class="col-md-offset-3 col-md-4">
					    <button type="submit" class="btn btn-default">Criar Contacto</button>
				    </div>
				</div>

				<input type="hidden" name="divisao" value="{{ $divisao }}" />
			{!! Form::close() !!}
		</div>
	</div>
</div>