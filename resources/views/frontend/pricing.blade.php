@extends('frontend.default')

@section('content')
<!DOCTYPE html><html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Egrupo - Preços</title>
	<link rel="icon" type="image/png" href="images/favicon.png" />
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/jquery-ui.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<!--[if IE 9]>
<link href="css/ie9.css" rel="stylesheet">
<![endif]-->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
	<!-- Hero -->
	<div class="hero content-page" style="background-image: url('images/hero-pricing-bg.png');">
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
							<li class="active">
								<a href="#" title="Pricing">
									<span data-hover="Preço">Preço</span>
								</a>
							</li>
							<li>
								<a href="{{ URL::to('contact' ) }}" title="Contact">
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
					<h1>Escolhe o teu plano!</h1>
				</div>
				<div class="col-md-8 col-md-offset-2">
					<p>O teu plano varia de acordo com a tua utilização. Grupos maiores estão inseridos em planos superiores.</p>
					<!-- <button type="button" class="btn btn-default">Take the tour</button> -->
				</div>
			</div>
		</div>
	</div>
	<!-- Content -->
	<div class="container section large-margin-bottom">
		<div class="row">
			<h2>Todos os planos, tudo incluído</h2>
			<!-- Price block -->
			<div class="col-md-3 col-sm-6 price">
				<div class="head">
					<h2>Grupo S</h2>
					<p>1€ <span>/ mês</span></p>
				</div>
				<ul class="check">
					<li>0-25 elementos</li>
				</ul>
				<a href="{{ URL::to('contact#join') }}"><button type="button" class="btn btn-primary">Entrar com este plano</button></a>
			</div>
			<!-- Price block -->
			<div class="col-md-3 col-sm-6 price popular">
				<div class="head">
					<h2>Grupo M</h2>
					<p>2€ <span>/ mês</span></p>
				</div>
				<ul class="check">
					<li>25-60 elementos</li>
				</ul>
				<a href="{{ URL::to('contact#join') }}"><button type="button" class="btn btn-primary">Entrar com este plano</button></a>
			</div>
			<!-- Price block -->
			<div class="col-md-3 col-sm-6 price">
				<div class="head">
					<h2>Grupo L</h2>
					<p>3€ <span>/ mês</span></p>
				</div>
				<ul class="check">
					<li>60-100 elementos</li>
				</ul>
				<a href="{{ URL::to('contact#join') }}"><button type="button" class="btn btn-primary">Entrar com este plano</button></a>
			</div>
			<!-- Price block -->
			<div class="col-md-3 col-sm-6 price">
				<div class="head">
					<h2>Grupo XL</h2>
					<p>4€ <span>/ mês</span></p>
				</div>
				<ul class="check">
					<li>100+ elementos por mês</li>
				</ul>
				<a href="{{ URL::to('contact#join') }}"><button type="button" class="btn btn-primary">Entrar com este plano</button></a>
			</div>
		</div>
	</div>

	<!-- Section -->
	<div class="container section large-margin-bottom">
		<div class="row faq">
			<h2>Perguntas Frequentes</h2>
			<div class="col-md-6 col-sm-6">
				<!-- Question -->
				<div class="question scrollme animateme" data-when="enter" data-from="0.5" data-to="0" data-opacity="0" data-translatex="-200">
					<p><strong>Para quem é o egrupo?</strong></p>
					<p>O egrupo é uma aplicação desenhada para os grupos da AEP - Associação de Escoteiros de Portugal.</p>
				</div>
				<!-- Question -->
				<div class="question scrollme animateme" data-when="enter" data-from="0.5" data-to="0" data-opacity="0" data-translatex="-200">
					<p><strong>Como posso experimentar esta aplicação?</strong></p>
					<p>Atualmente o registo está condicionado a convite, podes pedir o teu <a href="{{ URL::to('contact#join')}}">aqui</a> e assim que disponível serás contactado.</p>
				</div>
				<!-- Question -->
				<div class="question scrollme animateme" data-when="enter" data-from="0.5" data-to="0" data-opacity="0" data-translatex="-200">
					<p><strong>Esta aplicação é paga? Porquê?</strong></p>
					<p>Atualmente a aplicação encontra-se em fase de testes e para os participantes atuais a aplicação não é paga. No entanto, assim que entrar numa fase estável de consumo, este valor irá apenas para custos de manutenção. De notar que todos os grupos terão um período de experimentação para ver se esta ferramenta é uma mais valia ou não para a gestão dos seus grupos.</p>
				</div>
			</div>
			<div class="col-md-6 col-sm-6">
				<!-- Question -->
				<div class="question scrollme animateme" data-when="enter" data-from="0.5" data-to="0" data-opacity="0" data-translatex="200">
					<p><strong>Em que é que o egrupo está relacionado com o e-aep?</strong></p>
					<p>Em nada. O egrupo é um projeto independente que visa facilitar e organizar o dia-a-dia dos grupos de escoteiros que nasceu de necessidade própria.</p>
				</div>
				<!-- Question -->
				<div class="question scrollme animateme" data-when="enter" data-from="0.5" data-to="0" data-opacity="0" data-translatex="200">
					<p><strong>Quem está responsável por esta aplicação?</strong></p>
					<p>Mais informações sobre o responsável <a href="{{ URL::to('contact') }}">aqui</a>.</p>
				</div>
				<!-- Question -->
				<div class="question scrollme animateme" data-when="enter" data-from="0.5" data-to="0" data-opacity="0" data-translatex="200">
					<p><strong>Como posso saber mais?</strong></p>
					<p>Podes entrar em contacto com o responsável <a href="{{ URL::to('contact') }}">aqui</a>.</p>
				</div>
			</div>
		</div>
	</div>
	@include('frontend.beta_signup_form')
@stop