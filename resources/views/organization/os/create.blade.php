<div class="panel panel-default">
	<div class="panel-heading mpanel-head cursor-default" data-toggle="collapse" data-parent="#accordion" href="#cOS" aria-expanded="false" aria-controls="cOS">
		<h3 class="panel-title">Inserir Ordem de Serviço<span class="pull-right glyphicon glyphicon-collapse-down"></span></h3>
	</div>
	<div id="cOS" class="panel-collapse collapse" role="tabpanel" aria-labelledby="cOS">
		<div class="panel-body mpanel-body">
			{!! Form::open(array('route' => ['os.store', mySlug() ],'class' => 'form-horizontal' )) !!}
				<div class="form-group">
			    	<label for="id" class="col-md-3 control-label">Data</label>
			    	<div class="col-md-9">
			      		<input type="date" name="data" class="form-control" id="data" placeholder="" required>
			    	</div>
			  	</div>
		 		<div class="form-group">
			   		<label for="escoteiro_id" class="col-md-4 control-label">Nome/Atividade</label>
			   		<div class="col-md-8">
			   			<select class="form-control" required="required" name="escoteiro_id">
							<option value="0" selected="selected">Atividade</option>
							@foreach(App\Models\Escoteiro::getEscoteiros($divisao) as $e)
								<option value="{{ $e->id }}">{{ $e->nome }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="label" class="col-md-3 control-label">Descrição</label>
				    <div class="col-md-9">
				    	<input type="text" name="label" class="form-control" id="label" placeholder="Descrição (ex: Especialidade de Astronauta)" required>
				    </div>
				</div>

				<div class="form-group">
			   		<label for="type" class="col-md-3 control-label">Tipo</label>
			   		<div class="col-md-9">
			   			<select class="form-control" required="required" name="type" required>
							<option value="0" selected="selected">Outro</option>
							@foreach(DB::table('os_types')->get() as $os_type)
								<option value="{{ $os_type->type }}">{{ $os_type->desc }}</option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-md-offset-3 col-md-4">
					    <button type="submit" class="btn btn-default">Inserir Ordem de Serviço</button>
				    </div>
				</div>
				<input type="hidden" name="divisao" value="{{ $divisao }}" />
			{!! Form::close() !!}
		</div>
	</div>
</div>
