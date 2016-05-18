@extends('frontend.default')

@section('content')
<!DOCTYPE html><html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Egrupo - Contactos</title>
	<link rel="icon" type="image/png" href="images/favicon.png" />
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/jquery-ui.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
	<!-- Hero -->
	<div class="hero content-page" style="background-image: url('images/hero-contact-bg.png');">
		<!-- Navigation -->
		<div class="navbar" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a href="{{ URL::to('/') }}" title="egrupo">
						<img src="images/logo.png" alt="egrupo">
					</a>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="navbar-collapse collapse">
					<div class="collapse navbar-collapse">
						<ul id="menu-primary" class="nav navbar-nav">
							<li>
								<a href="{{ URL::to('/' ) }}" title="Home">
									<span data-hover="Início">Início</span>
								</a>
							</li>
							<li>
								<a href="{{ URL::to('tour' ) }}" title="Tour">
									<span data-hover="Funcionalidades">Funcionalidades</span>
								</a>
							</li>
							<li>
								<a href="{{ URL::to('pricing' ) }}" title="Pricing">
									<span data-hover="Preço">Preço</span>
								</a>
							</li>
							<li class="active">
								<a href="#" title="Contact">
									<span data-hover="Contacto">Contacto</span>
								</a>
							</li>
							<li>
								<a href="{{ URL::to('signup' ) }}" title="Contact">
									<span data-hover="Registar">Registar</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		@if(session()->has('messages'))
			@foreach(session()->get('messages') as $message)
				<div class="alert alert-info">{{ $message }}</div>
			@endforeach
		@endif
		<!-- Hero content -->
		<div class="container">
			<div class="row blurb">
				<div class="col-md-10 col-md-offset-1">
					<h1>Queremos saber a tua opinião!</h1>
				</div>
				<div class="col-md-8 col-md-offset-2">
					<p>Para um serviço completo e sempre em crescimento é importante receber feedback dos grupos para saber quais as suas reais necessidades e como é que o egrupo pode ajudar.</p>
				</div>
			</div>
		</div>
	</div>
	<!-- Content -->
	<div class="container">
		<!-- Section -->
		<div class="section">
			<!-- <div id="map"></div> -->
			<div class="row large-margin-top large-margin-bottom">
				<div class="col-md-12">
					<div class="row">
						{!! Form::open() !!}
							<div class="form-group col-md-4">
								<input type="text" name="name" class="form-control" placeholder="Nome *">
							</div>
							<div class="form-group col-md-4">
								<input type="email" name="email" class="form-control" placeholder="Email *">
							</div>
							<div class="form-group col-md-4">
								<input type="text" name="grupo" class="form-control" placeholder="Grupo">
							</div>
							<div class="col-md-12">
								<textarea class="form-control" name="message" rows="9" placeholder="Mensagem"></textarea>
								<button type="submit" class="btn btn-primary">Enviar Mensagem</button>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Section -->
	<div class="grey contact">
		<div class="container">
			<div class="row">
				<h2>Sobre o Responsável</h2>
				<!-- Icon block -->
				<div class="col-md-4 col-sm-4 icon">
					<span>{</span>
					<h5 class="no-underline">Info</h5>
					<p>Rui Santos, 2º Grupo</p>
				</div>
				<!-- Icon block -->
				<div class="col-md-4 col-sm-4 icon">
					<span>)</span>
					<h5 class="no-underline">Email</h5>
					<p>rui.santos@escoteiros.pt</p>
				</div>
				<!-- Icon block -->
				<div class="col-md-4 col-sm-4 icon">
					<span>&#xe00d;</span>
					<h5 class="no-underline">Telefone</h5>
					<p>962 646 578</p>
				</div>
			</div>
		</div>
	</div>				
	@include('frontend.beta_signup_form')
@stop