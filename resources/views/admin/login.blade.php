<html>
	<head>
		<title>Egrupo admin!</title>
		<link href="{{{ asset('/css/bootstrap.min.css') }}}" rel="stylesheet">
		<link href="{{{ asset('/css/signup.css') }}}" rel="stylesheet">
		<link href="{{{ asset('/css/sb-admin-2.css') }}}" rel="stylesheet">
		<link href="{{{ asset('/css/metisMenu.min.css') }}}" rel="stylesheet">
		
	</head>
	<body>

		<div class="container">
	        <div class="row">
	            <div class="col-md-4 col-md-offset-4">
	                <div class="login-panel panel panel-default">
	                    <div class="panel-heading">
	                        <h3 class="panel-title">Entrar</h3>
	                    </div>
	                    <div class="panel-body">
	                    	{!! Form::open(array('role' => 'form' )) !!}
	                            <fieldset>
	                                <div class="form-group">
	                                    <input class="form-control" placeholder="Username" name="user" type="text" value="{{ Request::old('user')}}" autofocus required>
	                                </div>
	                                <div class="form-group">
	                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
	                                </div>
	                                <!-- Change this to a button or input when using this as a form -->
	                                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
	                            </fieldset>
	                        {!! Form::close() !!}
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/metisMenu.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/sb-admin-2.js') }}"></script>
	</body>

</html>