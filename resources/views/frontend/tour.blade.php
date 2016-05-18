
@extends('frontend.default')

@section('content')
<!DOCTYPE html><html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Egrupo - Funcionalidades</title>
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
	<div class="hero content-page" style="background-image: url('images/hero-tour-bg.png');">
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
								<a href="{{ URL::to('/') }}" title="Home">
									<span data-hover="Início">Início</span>
								</a>
							</li>
							<li class="active">
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
					<h1>O Tão esperado</h1>
				</div>
				<div class="col-md-8 col-md-offset-2">
					<p>No egrupo encontras todas as funcionalidades necessárias à gestão de uma divisão, e de um grupo de escoteiros</p>
					<a href="{{ URL::to('contact#join') }}"><button type="button" class="btn btn-default">Quero experimentar</button></a>
				</div>
			</div>
		</div>
	</div>
	<!-- Content -->
	<div class="container">
		<!-- Section -->
		<div class="section">
			<h2>AS FUNCIONALIDADES MAIS POPULARES</h2>
			<!-- Tabs -->
			<div id="tabs">
				<ul>
					<li>
						<h3><a href="#tabs-1">
							<span>a</span> Atividades </a></h3>
						</li>
						<li>
							<h3><a href="#tabs-2">
								<span>v</span> Progresso </a></h3>
							</li>
							<li>
								<h3><a href="#tabs-3">
									<span>^</span> Informações Pessoais </a></h3>
								</li>
								<li>
									<h3><a href="#tabs-4">
										<span>)</span> Ordens de Serviço </a></h3>
									</li>
								</ul>
								<!-- Tab 1 -->
								<div class="indv-tab scrollme" id="tabs-1">
									<div class="col-md-6 img-preview" data-when="enter" data-from="1" data-to="0.15" data-translatex="-400">
										<img src="images/feature_atividade.png">
									</div>
									<div class="container">
										<div class="row">
											<div class="col-md-6 col-md-push-6">
												<h4 class="left">ATIVIDADES</h4>
												<p>A partir do egrupo podes gerir de forma mais eficiente os planos trimestrais das divisões.</p>
												<p>Depois de criar as diversas atividades do teu plano, podes acrescentar informações importantes que não te podes esquecer, informação que queres passar aos jovens/encarregados de educação.</p>
												<p>Sugerimos também que escrevas os objetivos da atividade antes de a realizar e uma breve descrição depois, mais tarde podes rever o histórico das atividades passadas e utilizar a informação para novas atividades, ordens de serviço, cadernos de caça, ...</p>
											</div>
										</div>
									</div>
								</div>
								<!-- Tab 2 -->
								<div class="indv-tab scrollme" id="tabs-2">
									<div class="col-md-6 img-preview" data-when="enter" data-from="1" data-to="0.15" data-translatex="-400">
										<img src="images/feature_progresso.png" >
									</div>
									<div class="container">
										<div class="row">
											<div class="col-md-6 col-md-push-6">
												<h4 class="left">PROGRESSO PESSOAL</h4>
												<p>Com o egrupo podes manter o registo do progresso de cada elemento, desde a Alcateia até à Chefia! Todos os desafios, etapas e especialidades registados no mesmo sítio, com as datas e descrições.</p>
												<p>Para ti dirigente isto é fantástico, pois tens toda esta informação registada no mesmo sítio, de todos os jovens e de todo o seu percurso no grupo. Permite-te não só teres uma noção dos teus jovens, como também do estado do progresso na divisão e no grupo.</p>
											</div>
										</div>
									</div>
								</div>
								<!-- Tab 3 -->
								<div class="indv-tab scrollme" id="tabs-3">
									<div class="col-md-6 img-preview" data-when="enter" data-from="1" data-to="0.15" data-translatex="-400">
										<img src="images/feature_infos.png" >
									</div>
									<div class="container">
										<div class="row">
											<div class="col-md-6 col-md-push-6">
												<h4 class="left">INFORMAÇÕES PESSOAIS</h4>
												<p>Tens toda a informação dos jovens da tua divisão acessível? Tens os números de telefone dos jovens / Encarregados de Educação gravados no telemóvel, mas e nomes completos, as moradas, ou até mesmo os NIFs ou os emails dos pais?</p>
												<p>Também é possível guardar outro tipo de informações úteis como alergias, doenças ou cuidados especiais a ter com o escoteiro em questão.</p>
												<p>Porque não centralizar toda esta informação no mesmo sítio, onde registas o dia-a-dia da tua divisão? De fácil acesso para ti e para todos os elementos da tua chefia.</p>
											</div>
										</div>
									</div>
								</div>
								<!-- Tab 4 -->
								<div class="indv-tab scrollme" id="tabs-4">
									<div class="col-md-6 img-preview" data-when="enter" data-from="1" data-to="0.15" data-translatex="-400">
										<img src="images/feature_os.png" >
									</div>
									<div class="container">
										<div class="row">
											<div class="col-md-6 col-md-push-6">
												<h4 class="left">ORDENS DE SERVIÇO</h4>
												<p>Com o egrupo, toda a informação que foste inserindo no dia-a-dia para a gestão da tua divisão vai ser utilizado para, de forma automática, gerar a ordem de serviço do grupo inteiro!</p>
												<p>as ordens de serviço deixam de ser uma preocupação. Basta que vás utilzando o egrupo regularmente e registando as atividades e eventos, no final é quase só carregar num botão!</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Section -->
						<div class="section">
							<h2>Agora também podes registar o teu inventário no egrupo</h2>
							<div class="row">
								<div class="col-md-10 col-md-push-1 scrollme">
									<p class="italic centered">No egrupo também é possível registar o inventário do teu material. Assim que criares um local de arrumação, podes começar a inserir o teu material. O Egrupo organiza o teu material por local de arrumação e por categorias.</p>
									<p class="centered margin-top no-margin-bottom animateme" data-when="enter" data-from="1" data-to="0.15" data-translatey="600"><img src="images/feature_material.png"></p>
								</div>
							</div>
						</div>
					</div>
					<!-- Section -->
					<div class="grey">
						<div class="container">
							<div class="row">
								<!-- Icon block -->
								<div class="col-md-4 col-sm-6 icon scrollme animateme" data-when="enter" data-from=".7" data-to="0.15" data-opacity="0" data-scale="0" data-translatey="100">
									<span class="animateme" data-when="enter" data-from="1" data-to="0.15" data-rotatez="-90">M</span>
									<h5 class="no-underline">Registo de Progresso</h5>
									<p>Podes guardar todo o progresso de todos os teus elementos.</p>
								</div>
								<!-- Icon block -->
								<div class="col-md-4 col-sm-6 icon scrollme animateme" data-when="enter" data-from=".7" data-to="0.15" data-opacity="0" data-scale="0" data-translatey="100">
									<span class="animateme" data-when="enter" data-from="1" data-to="0.15" data-rotatez="-90">R</span>
									<h5 class="no-underline">Registo de Atividades</h5>
									<p>Guarda todas as atividades que realizaste, adiciona uma descrição, </p>
								</div>
								<!-- Icon block -->
								<div class="col-md-4 col-sm-6 icon scrollme animateme" data-when="enter" data-from=".7" data-to="0.15" data-opacity="0" data-scale="0" data-translatey="100">
									<span class="animateme" data-when="enter" data-from="1" data-to="0.15" data-rotatez="-90">&#xe00b;</span>
									<h5 class="no-underline">Ordens de Serviço</h5>
									<p>Gera as ordens de serviço com um clique.</p>
									<br />
								</div>
								<!-- Icon block -->
								<div class="col-md-4 col-sm-6 icon scrollme animateme" data-when="enter" data-from=".7" data-to="0.15" data-opacity="0" data-scale="0" data-translatey="100">
									<span class="animateme" data-when="enter" data-from="1" data-to="0.15" data-rotatez="-90">&#xe00d;</span>
									<h5 class="no-underline">Acesso aplicação móvel</h5>
									<p>Todos os planos incluem acesso à aplicação móvel, o que torna ainda mais fácil o acesso e registo da informação do teu grupo.</p>
								</div>
								<!-- Icon block -->
								<div class="col-md-4 col-sm-6 icon scrollme animateme" data-when="enter" data-from=".7" data-to="0.15" data-opacity="0" data-scale="0" data-translatey="100">
									<span class="animateme" data-when="enter" data-from="1" data-to="0.15" data-rotatez="-90">&#xe012;</span>
									<h5 class="no-underline">Curriculo Escotista</h5>
									<p>Gera todas as atividades que o teu escoteiro já participou, todo o progresso que ele alcançou num único ficheiro.</p>
								</div>
								<!-- Icon block -->
								<div class="col-md-4 col-sm-6 icon scrollme animateme" data-when="enter" data-from=".7" data-to="0.15" data-opacity="0" data-scale="0" data-translatey="100">
									<span class="animateme" data-when="enter" data-from="1" data-to="0.15" data-rotatez="-90">&#xe026;</span>
									<h5 class="no-underline">E mais</h5>
									<p>O egrupo tem uma integração contínua, novas funcionalidades e facilidades vão sendo adicionadas consoante as necessidades de todos.</p>
								</div>
							</div>
						</div>
					</div>
					<!-- Section -->
					<div class="section two-column">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<h4 class="left">Automatismos</h4>
									<p>Com o egrupo, podem ser facilmente integrados vários automatismos e funcionalidades para facilitar as tarefas dos dirigentes. A lista ainda é pequena, à medida que forem encontradas novas necessidades a lista vai sendo complementada.</p>
									<!-- Icon list -->
									<div class="row icon-list scrollme animateme" data-when="enter" data-from=".7" data-to="0.15" data-opacity="0" data-translatex="-200">
										<div class="col-md-2 col-sm-2">
											<span>&#xe009;</span>
										</div>
										<div class="col-md-9 col-sm-10 content">
											<h5 class="no-underline left">Lista Nominal do PNEC</h5>
											<p>Em vez de preencheres a lista que os serviços centrais te obrigam a enviar, gera a lista diretamente a partir do teu egrupo.</p>
										</div>
									</div>
									<!-- Icon list -->
									<div class="row icon-list scrollme animateme" data-when="enter" data-from=".7" data-to="0.15" data-opacity="0" data-translatex="-200">
										<div class="col-md-2 col-sm-2">
											<span>m</span>
										</div>
										<div class="col-md-9 col-sm-10 content">
											<h5 class="no-underline left">Cadernos de Progresso</h5>
											<p>No egrupo os cadernos de progresso estão disponíveis para uma consulta rápida.</p>
										</div>
									</div>
									<!-- Icon list -->
									<div class="row icon-list scrollme animateme" data-when="enter" data-from=".7" data-to="0.15" data-opacity="0" data-translatex="-200">
										<div class="col-md-2 col-sm-2">
											<span>5</span>
										</div>
										<div class="col-md-9 col-sm-10 content">
											<h5 class="no-underline left">Informação Visual</h5>
											<p>Podes consultar o dashboard do teu grupo para ter uma acesso visual à informação mais importante das divisões do teu grupo. Distribuição de elementos pelas divisões, distribuição das etapas nas diferentes divisões são só as primeiras...</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<img src="images/lista_nominal.png" class="scrollme animateme" data-when="enter" data-from=".7" data-to="0.15" data-opacity="0" data-translatex="300">
								</div>
							</div>
						</div>
					</div>
					@include('frontend.beta_signup_form')
@stop