<div class="panel panel-default">
	<div class="panel-heading mpanel-head cursor-default" data-toggle="collapse" data-parent="#accordion" href="#cLembrete" aria-expanded="false" aria-controls="cLembrete">
		<h3 class="panel-title">Criar Lembrete<span class="pull-right glyphicon glyphicon-collapse-down"></span></h3>
	</div>
	<div id="cLembrete" class="panel-collapse collapse" role="tabpanel">
		<div class="panel-body mpanel-body">
			{!! Form::open(array('route' => [ 'lembretes.store' , mySlug() ],'class' => 'form-horizontal' )) !!}
				<div class="form-group">
			    	<label for="remindme_at" class="col-md-4 control-label">Lembrar a partir de</label>
			    	<div class="col-md-8">
			      		<input type="date" name="remindme_at" class="form-control" id="remindme_at" placeholder="" required>
			    	</div>
			  	</div>
		 		<div class="form-group">
			   		<label for="label" class="col-md-3 control-label">Descrição</label>
			   		<div class="col-md-9">
						<input type="text" name="label" class="form-control" id="label" placeholder="Descrição (ex: Preparar Expedição)" required>
					</div>
				</div>

				<input type="hidden" name="user_id" value="{{ Auth::user()->id}} " />
				<input type="hidden" name="divisao" value="{{ $divisao }}" />

				<div class="form-group">
					<div class="col-md-offset-3 col-md-4">
					    <button type="submit" class="btn btn-default">Criar lembrete</button>
				    </div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
