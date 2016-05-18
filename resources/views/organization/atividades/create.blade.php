<div class="panel panel-default">
	<div class="panel-heading mpanel-head cursor-default" @if($accordion) data-toggle="collapse" data-parent="#accordion" href="#cAtividade" aria-expanded="false" aria-controls="cAtividade" @endif>
		<h3 class="panel-title">Criar Atividade<span class="pull-right glyphicon glyphicon-collapse-down"></span></h3>
	</div>
	<div @if($accordion) id="cAtividade" class="panel-collapse collapse" role="tabpanel" @endif>
		<div class="panel-body mpanel-body">
			{!! Form::open(array('route' => [ 'atividades.store' , mySlug() ],'class' => 'form-horizontal' )) !!}
			 	<div class="form-group">
			    	<label for="id" class="col-md-3 control-label">Data</label>
			    	<div class="col-md-9">
			      		<input type="date" name="performed_at" class="form-control" id="performed_at" placeholder="">
			    	</div>
			  	</div>
				<div class="form-group">
					<label for="nome" class="col-md-3 control-label">Nome</label>
				    <div class="col-md-9">
				    	<input type="text" name="nome" class="form-control" id="nome" placeholder="Ex: Atividades de patrulha">
				    </div>
				</div>

				<div class="form-group">
					<label for="divisao" class="col-md-3 control-label">Divisão</label>
					<div class="col-md-9">
						<select name="divisao" class="form-control">
							<option value="{{ $divisao }}" selected>{{ App\Models\Divisao::getLabel($divisao) }}</option>
							<option value="{{ App\Models\Divisao::$GRUPO }}">Grupo</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-md-offset-3 col-md-4">
					    <button type="submit" class="btn btn-default">Criar Atividade</button>
				    </div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
