<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title text-center">Criar Jogo</h3>
	</div>
	<div class="panel-body">
		{!! Form::open(array('route' => ['jogos.store', mySlug() ],'class' => 'form-horizontal' )) !!}
			<div class="form-group">
		    	<label for="nome" class="col-md-3 control-label">Nome</label>
		    	<div class="col-md-9">
		      		{!! Form::text('nome',null,array('class' => 'form-control', 'placeholder' => 'Sirumba', 'required' => 'required' )) !!}
		    	</div>
		  	</div>

		  	<div class="form-group">
		    	<label for="duracao" class="col-md-3 control-label">Duração(m)</label>
		    	<div class="col-md-9">
		      		{!! Form::text('duracao',null,array('class' => 'form-control', 'placeholder' => '10', 'required' => 'required' )) !!}
		    	</div>
		  	</div>

		  	<div class="form-group">
		    	<label for="n_participantes" class="col-md-3 control-label">Participantes</label>
		    	<div class="col-md-9">
		      		{!! Form::text('n_participantes',null,array('class' => 'form-control', 'placeholder' => 'n aconselhado de participantes', 'required' => 'required' )) !!}
		    	</div>
		  	</div>

		  	<div class="form-group">
		    	<label for="n_participantes" class="col-md-3 control-label">Divisões</label>
		    	<div class="col-md-offset-1 col-md-8">
		      		<div class="checkbox">{!! Form::checkbox('divisao_alcateia', null, null) !!}Alcateia</div>
		      		<div class="checkbox">{!! Form::checkbox('divisao_tes', null, null) !!}TEs</div>
		      		<div class="checkbox">{!! Form::checkbox('divisao_tex', null, null) !!}TEx</div>
		      		<div class="checkbox">{!! Form::checkbox('divisao_cla', null, null) !!}Clã</div>
		    	</div>
		  	</div>


	 		<div class="form-group">
		   		<label for="descricao" class="col-md-3 control-label">Descrição</label>
		   		<div class="col-md-9">
		   			{!! Form::textarea('descricao',null,array('class' => 'form-control','rows' => '8' ,'placeholder' => 'Fazemos uma roda e cantamos o Kumba-Ya','required' => 'required' )) !!}
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-4">
				    <button type="submit" class="btn btn-default">Criar jogo</button>
			    </div>
			</div>
		{!! Form::close() !!}
	</div>
</div>
