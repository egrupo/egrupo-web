<div class="panel panel-default">
	<div class="panel-heading mpanel-head cursor-default" data-toggle="collapse" data-parent="#accordion" href="#cBulk" aria-expanded="false" aria-controls="cBulk">
		<h3 class="panel-title">Inserir várias provas por elemento<span class="pull-right glyphicon glyphicon-collapse-down"></span></h3>
	</div>
	<div id="cBulk" class="panel-collapse collapse" role="tabpanel" aria-labelledby="cBulk">
		<div class="panel-body mpanel-body">
			{!! Form::open(array('route' => [ 'escoteiros.concluirprovas' , mySlug() ] ,'class' => 'form-horizontal' )) !!}
			 	<div class="form-group">
			   		<label for="escoteiro_id" class="col-md-3 control-label">Nome</label>
			   		<div class="col-md-9">
			   			<select class="form-control" required="required" name="escoteiro_id">
							@foreach(App\Models\Escoteiro::getEscoteiros($divisao) as $e)
								<option value="{{ $e->id }}">{{ $e->nome }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
			    	<label class="col-md-3 control-label">Data</label>
			    	<div class="col-md-9">
			      		<input type="date" name="concluded_at" class="form-control" placeholder="">
			    	</div>
			  	</div>

			  	<div class="form-group">
			  		<label class="col-md-3 control-label">Provas</label>
			  		<div class="col-md-9">
			  			<input type="text" name="provas" class="form-control" placeholder="201,202,203">
			  		</div>
			  	</div>

				<div class="form-group">
					<div class="col-md-offset-3 col-md-4">
					    <button type="submit" class="btn btn-default">Inserir</button>
				    </div>
				</div>

				<input type="hidden" name="divisao" value="{{ $divisao }}" />
			{!! Form::close() !!}
		</div>
	</div>
</div>