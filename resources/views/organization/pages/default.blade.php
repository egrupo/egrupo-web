<html>
	</head>
		<script src="http://code.jquery.com/jquery.js"></script>
		{{ HTML::script('js/bootstrap.min.js') }}
		<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
		<link href="{{{ asset('/css/bootstrap.min.css') }}}" rel="stylesheet">
		<link href="{{{ asset('/css/style.css') }}}" rel="stylesheet">

		@yield('header')
	</head>

	<body>
		<div>
			@if(Auth::user()->level <= 3)
				@include('layouts.frames.header')
			@elseif(Auth::user()->level == 4)
				@include('layouts.frames.header_escoteiros')
			@else
				@include('layouts.frames.header_pais')
			@endif
		</div>
			
		<div class="content">
			<div class="container">
				@if($errors->has())
					@foreach($errors->all() as $error)
						<div class="alert alert-danger" role="alert">{{ $error }}</div>
					@endforeach
				@endif

				@if (Session::has('messages'))
					@foreach(Session::get('messages') as $message)
			   			<div class="alert alert-info">{{ $message }}</div>
					@endforeach
				@endif

				@yield('content')
			</div>
		</div>

		<div class="footer">
			
		</div>

		
	</body>
</html>