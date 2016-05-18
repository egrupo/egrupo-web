<html>
	<head>
		<title>Regista aqui o teu grupo!</title>
		<link href="{{{ asset('/css/bootstrap.min.css') }}}" rel="stylesheet">
		<link href="{{{ asset('/css/signup.css') }}}" rel="stylesheet">
	</head>
	<body>

		<div class="container">

			@if($errors->has())
				@foreach($errors->all() as $error)
					<div class="alert alert-danger" role="alert">{{ $error }}</div>
				@endforeach
			@endif

			{!! Form::open(array('class' => 'form-signin' )) !!}
	        	<h2 class="form-signin-heading">Registar Novo Grupo</h2>
	        	<div class="form-group">
	        		<label for="inputEmail" class="sr-only">Email address</label>
		        	<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Endereço de email" value="{{ Request::old('email')}}" required autofocus>
		    	</div>

		    	<div class="form-group">
			        <label for="inputUsername" class="sr-only">Username</label>
			        <input type="text" name="user" id="inputUsername" class="form-control" placeholder="Username" value="{{ Request::old('user')}}" required >
			    </div>

			    <div class="form-group">
			        <label for="inputNome" class="sr-only">Nome</label>
			        <input type="text" name="name" id="inputNome" class="form-control" placeholder="Nome" value="{{ Request::old('name')}}" required >
				</div>

				<div class="form-group">
			        <label for="inputGrupo" class="sr-only">Grupo</label>
			        <input type="number" name="organization_number" id="inputGrupo" class="form-control" placeholder="Numero de Grupo" value="{{ Request::old('organization_number')}}" required >
			    </div>

			    <div class="form-group">
			        <label for="inputPassword" class="sr-only">Password</label>
			        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
			    </div>

		        <div class="form-group">
			        <label for="inputPassword" class="sr-only">Confirmar Password</label>
			        <input type="password" name="password_confirmation" id="inputPassword" class="form-control" placeholder="Confirma password" required>
			    </div>

		        <br />
		        <label for="inputPassword" class="sr-only">Convite</label>
		        <input type="text" name="invite_token" class="form-control" placeholder="Convite" required>
		        <p class="small text-center">Não tens um convite? Pede <a href="{{ URL::to('contact#join') }}">aqui</a></p>
		        <br>
	        	<button class="btn btn-lg btn-primary btn-block" type="submit">Registar</button>
  			{!! Form::close() !!}
    	</div> <!-- /container -->

	</body>

</html>