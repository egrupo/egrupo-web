<div class="panel panel-default">
	<div class="panel-heading mpanel-head cursor-default" @if($accordion) data-toggle="collapse" data-parent="#accordion" href="#cEscoteiro" aria-expanded="false" aria-controls="cEscoteiro" @endif>
		<h3 class="panel-title">Criar Elemento<span class="pull-right glyphicon glyphicon-collapse-down"></span></h3>
	</div>
	<div @if($accordion) id="cEscoteiro" class="panel-collapse collapse" role="tabpanel" @endif>
		<div class="panel-body mpanel-body">
			{!! Form::open(array('route' => ['escoteiros.store',mySlug()],'class' => 'form-horizontal' )) !!}
			 	<div class="form-group">
			    	<label for="id_associativo" class="col-md-3 control-label">Número associativo</label>
			    	<div class="col-md-9">
			      		<input type="numeric" name="id_associativo" class="form-control" id="id_associativo" placeholder="numero associativo">
			    	</div>
			  	</div>
				<div class="form-group">
					<label for="nome" class="col-md-3 control-label">Nome</label>
				    <div class="col-md-9">
				    	<input type="text" name="nome" class="form-control" id="nome" placeholder="primeiro e último">
				    </div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-3 col-md-4">
					    <button type="submit" class="btn btn-default">Criar Elemento</button>
				    </div>
				</div>
				<input type="hidden" name="divisao" value="{{ $divisao }}" />
			{!! Form::close() !!}
		</div>
	</div>
</div>