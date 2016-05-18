<div class="panel panel-default">
	<div class="panel-heading mpanel-head cursor-default" data-toggle="collapse" data-parent="#accordion" href="#cAviso" aria-expanded="false" aria-controls="cAviso">
		<h3 class="panel-title">Criar Aviso<span class="pull-right glyphicon glyphicon-collapse-down"></span></h3>
		
	</div>
	<div id="cAviso" class="panel-collapse collapse" role="tabpanel" aria-labelledby="cAviso">
		<div class="panel-body mpanel-body">
			{!! Form::open(array('route' => ['avisos.store' , mySlug() ],'class' => 'form-horizontal' )) !!}
				<div class="form-group">
					<label for="aviso" class="col-md-3 control-label">Aviso</label>
				    <div class="col-md-9">
				    	<input type="text" name="descricao" class="form-control" id="aviso" placeholder="estudar prova 202 e 203">
				    </div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Nome</label>
					<div class="col-md-9">
						<select class="form-control" name="target_id">
							<option value="0">Divisão</value>
							@foreach(App\Models\Escoteiro::getEscoteiros($divisao) as $escoteiro)
								<option value="{{ $escoteiro->id }}">{{ $escoteiro->nome }}</value>
							@endforeach
							
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-3 col-md-4">
					    <button type="submit" class="btn btn-default">Criar Aviso</button>
				    </div>
				</div>
				<input type="hidden" name="divisao" value="{{ $divisao }}" />
			{!! Form::close() !!}
		</div>
	</div>
</div>