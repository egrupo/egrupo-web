<div id="join" class="green sign-up no-margin-top">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Quero experimentar</h2>
				<p class="italic centered">O egrupo está em fase de testes, tendo apenas algumas pessoas accesso a esta ferramenta. Ao longo do tempo vamos abrindo a plataforma a mais grupos. Em baixo podes inserir os dados para receber um convite assim que o egrupo estiver pronto para te receber!</p>
				{!! Form::open(array('route' => 'invites.store','method' => 'POST')) !!}
					<div class="form-group">
						<p><input type="text" class="form-control" name="nome" placeholder="O teu nome" required>
						<input type="text" class="form-control" name="email" placeholder="O teu email" required></p>
						<p><input type="numeric" class="form-control" name="numero_grupo" placeholder="Nº grupo" required>
						<input type="numeric" class="form-control" name="npessoas" placeholder="numero efetivo do grupo" required></p>
						<button type="submit" class="btn btn-default">Enviar</button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>