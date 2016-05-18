@extends('frontend.default')

@section('content')
<!DOCTYPE html><html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Egrupo</title>
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
	<div class="hero">
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
							<li class="active">
								<a href="{{ URL::to('/') }}" title="Home">
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
					<h1>Chegou o egrupo</h1>
				</div>
				<div class="col-md-8 col-md-offset-2">
					<p>Gerir a tua divisão, o teu grupo, acabou de ficar mais fácil, rápido e divertido.</p>
					<a href="{{ URL::to('tour') }}"><button type="button" class="btn btn-default">Quero saber mais</button></a>
					<a href="{{ URL::to('contact#join') }}"><button type="button" class="btn btn-primary">Quero experimentar</button></a>
				</div>
			</div>
			<div class="row preview">
				<div class="col-md-10 col-md-offset-1">
					<img src="images/egrupo-app.png" class="img-responsive">
				</div>
			</div>
		</div>
	</div>
	<!-- Content -->
	<div class="container">
		<div class="section">
			<h2>Neste momento</h2>
			<div class="row">
				<div class="col-md-4 stat-item">
					<div class="stat-header">{{ App\AdminUtils::getFrontendEscoteiros() }}+</div>
					<div class="stat-label">Escoteiros nas<br />quatro divisões</div>
				</div>
				<div class="col-md-4 stat-item">
					<div class="stat-header">{{ App\AdminUtils::getFrontendEtapas() }}+</div>
					<div class="stat-label">Etapas<br />concluídas</div>
				</div>
				<div class="col-md-4 stat-item">
					<div class="stat-header">{{ App\AdminUtils::getFrontendAtividades() }}+</div>
					<div class="stat-label">Atividades<br />registadas</div>
				</div>
			</div>
		</div>
	</div>
		<!-- Section -->
		<!-- Section -->
		<div class="container">
			<div class="section">
				<h2>Quem usa o Egrupo</h2>
				<div class="row">
					<!-- Customer block -->
					<div class="col-md-4 col-sm-4 customers">
						<img src="images/user-2.png" class="img-circle testimonial-avatar scrollme animateme" data-when="enter" data-from="1" data-to="0.15" data-opacity="0" data-scale="0" data-rotatez="90">
						<p><em>&quot;O egrupo permite-me ter a informação da divisão toda centralizada (desafios, informação dos jovens, atividades, presenças, ordens de serviço, ...).
Para além de centralizada está disponivel em qualquer lugar e não naquele "caderno que deixei em casa" ou naquela folha que ficou no grupo.&quot;</em></p>
						<p><strong>Catarina Neves</strong><br /> Chefe da Tribo de Exploradores - 2º Grupo</p>
					</div>
					<!-- Customer block -->
					<div class="col-md-4 col-sm-4 customers">
						<img src="images/user-1.png" class="img-circle testimonial-avatar scrollme animateme" data-when="enter" data-from="1" data-to="0.15" data-opacity="0" data-scale="0" data-rotatez="90">
						<p><em>&quot;O egrupo é incrível! Permite-me dedicar mais tempo ao escotismo e menos às burocracias. Sou suspeito, mas é a melhor maneira de gerir burocracias que arranjei até hoje.&quot;</em></p>
						<p><strong>Rui Santos</strong><br /> Chefe de Clã - 2º Grupo</p>
					</div>
					<!-- Customer block -->
					<div class="col-md-4 col-sm-4 customers">
						<img src="images/user-3.png" class="img-circle testimonial-avatar scrollme animateme" data-when="enter" data-from="1" data-to="0.15" data-opacity="0" data-scale="0" data-rotatez="90">
						<p><em>&quot;O egrupo é uma óptima ferramenta, conseguimos ter todas as informações juntas, organizadas e acessíveis a todos. 
Ao juntarmos todos os documentos que tínhamos de preencher atividade após atividade, no egrupo, torna tudo muito mais fácil, menos chato e poupamos bastante tempo :)&quot;</em></p>
						<p><strong>Magda Maia</strong><br /> Àquelá - 2º Grupo</p>
					</div>
				</div>
			</div>
		</div>
@stop
					