<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title text-center">Pesquisar</h3>
	</div>
	<div class="panel-body">
		{!! Form::model($input, array('route' => ['jogos.search', mySlug()], 'class' => 'form-horizontal', 'method' => 'POST')) !!}	
		  	<div class="form-group">
		    	<label for="n_participantes" class="col-md-4 control-label">Participantes</label>
		    	
		    	<div class="col-md-3">
		    		{!! Form::text('n_participantes_min', null, array('class' => 'form-control', 'placeholder' => 'min' ) ) !!}
	      		</div>
	      		<div class="col-md-1">
	      			<label class="control-label">a</label>
	      		</div>
		      	<div class="col-md-3">
		      		{!! Form::text('n_participantes_max', null, array('class' => 'form-control', 'placeholder' => 'max' ) ) !!}
		      	</div>	
		    	
		  	</div>

		  	<div class="form-group">
		    	<label class="col-md-4 control-label">Duração(m)</label>
		    	
		    	<div class="col-md-3">
		      		{!! Form::text('duracao_min', null, array('class' => 'form-control', 'placeholder' => 'min' ) ) !!}
	      		</div>
	      		<div class="col-md-1">
	      			<label class="control-label">a</label>
	      		</div>
		      	<div class="col-md-3">
		      		{!! Form::text('duracao_max', null, array('class' => 'form-control', 'placeholder' => 'max' ) ) !!}
		      	</div>	
		  	</div>

		  	<div class="form-group">
		    	<label for="n_participantes" class="col-md-3 control-label">Divisões</label>
		    	<div class="col-md-offset-2 col-md-7">
		      		<div class="checkbox">{!! Form::checkbox('divisao_alcateia', null, null) !!}Alcateia</div>
		      		<div class="checkbox">{!! Form::checkbox('divisao_tes', null, null) !!}TEs</div>
		      		<div class="checkbox">{!! Form::checkbox('divisao_tex', null, null) !!}TEx</div>
		      		<div class="checkbox">{!! Form::checkbox('divisao_cla', null, null) !!}Clã</div>
		    	</div>
		  	</div>

			<div class="form-group">
				<div class="col-md-4">
				    <button type="submit" class="btn btn-default">Pesquisar</button>
			    </div>
			</div>
		{!! Form::close() !!}
	</div>
</div>