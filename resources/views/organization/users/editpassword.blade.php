@extends('organization.default')

@section('header')
	<title>Mudar password</title>
@stop

@section('content')
	<div class="spacer-mini"></div>
	<div class="row">
		{!! Form::open(['route' => ['user.showchangepassword',mySlug()],'method' => 'POST']) !!}
			<div class="form-group">
				<div class="col-md-3">
					{!! Form::password('password_nova_1',array('placeholder' => 'nova password','class' => 'form-control')) !!}
				</div>
				<div class="col-md-3">
					{!! Form::password('password_nova_2',array('placeholder' => 'nova password','class' => 'form-control')) !!}
					</div>
					{!! Form::submit('Mudar password',array('class' => 'btn btn-large btn-primary')) !!}
				</div>
			</div>
		{!! Form::close() !!}
	</div>
@stop