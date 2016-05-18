<html>
	<head>
		@yield('header')
		<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/sb-admin-2.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">
		<!-- <link rel="stylesheet" href="{{ URL::asset('css/metisMenu.min.css') }}"> -->
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/metisMenu/2.5.0/metisMenu.min.css">
		<link rel="stylesheet" href="{{ URL::asset('css/egrupo.css') }}">
	</head>
	<body>
		<div id="wrapper">
			<!-- Navigation -->
			@if(Auth::user()->level <= 3)
				@include('frames.chefes_menu')
			@elseif(Auth::user()->level == 4)
				@include('frames.escoteiros_menu')
			@else
				@include('frames.pais_menu')
			@endif

			<div id="page-wrapper">
				<div class="row">
					@if($errors->has())
						<div class="spacer-mini"></div>
						@foreach($errors->all() as $error)
							<div class="alert alert-danger" role="alert">{{ $error }}</div>
						@endforeach
					@endif

					@if(session()->has('erros'))
						<div class="spacer-mini"></div>
						@foreach(session()->get('erros') as $message)
				   			<div class="alert alert-danger">{{ $message }}</div>
						@endforeach
					@endif

					@if(session()->has('messages'))
						<div class="spacer-mini"></div>
						@foreach(session()->get('messages') as $message)
				   			<div class="alert alert-info">{{ $message }}</div>
						@endforeach
					@endif


				</div>

				@yield('content')
			</div>

			<div class="footer"></div>
			
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		{!! Html::script('js/bootstrap.min.js') !!}
		<script src="//cdnjs.cloudflare.com/ajax/libs/metisMenu/2.5.0/metisMenu.min.js"></script>
		{!! Html::script('js/sb-admin-2.js') !!}
		{!! Html::script('js/divisao.js') !!}
		@yield('scripts')
	</body>
</html>