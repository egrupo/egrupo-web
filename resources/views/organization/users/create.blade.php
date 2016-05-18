<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Criar Utilizador</h3>
	</div>
	<div class="panel-body">
		{!! Form::open(array('route' => ['users.store',mySlug()],'class' => 'form-horizontal' )) !!}
		 	<div class="form-group">
		    	<label for="user" class="col-md-3 control-label">Username</label>
		    	<div class="col-md-9">
		      		<input type="numeric" name="user" class="form-control" placeholder="username" required>
		    	</div>
		  	</div>
			<div class="form-group">
				<label for="nome" class="col-md-3 control-label">Nome</label>
			    <div class="col-md-9">
			    	<input type="text" name="nome" class="form-control" id="nome" placeholder="primeiro e último" required>
			    </div>
			</div>

			<div class="form-group">
				<label for="email" class="col-md-3 control-label">Email</label>
			    <div class="col-md-9">
			    	<input type="text" name="email" class="form-control" id="email" placeholder="email@exemplo.com" required>
			    </div>
			</div>

			<div class="form-group">
				<label for="level" class="col-md-3 control-label">Nível</label>
				<div class="col-md-9">
					<select class="form-control" name="level">
						<option value="1">Admin</value>
						<option value="2">Chefe</value>
						<option value="3">Caminheiro</value>
						<option value="4">Escoteiro</value>
						<option value="5">EE</value>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-3 col-md-4">
				    <button type="submit" class="btn btn-default">Criar Elemento</button>
			    </div>
			</div>
		{!! Form::close() !!}
	</div>
</div>