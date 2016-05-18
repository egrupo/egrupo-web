<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      	<a class="navbar-brand text-uppercase" href="{{ URL::to('dashboard') }}">{{ mySlug() }}</a>
	    </div>

	    <div class="collapse navbar-collapse">
	    	<ul class="nav navbar-nav">
				<li class="dropdown">
					<a id="drop0" href="" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-folder-open"></i> Divisão<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('divisoes.show',[ mySlug() , 'Alcateia'] ) }}">Alcateia</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('divisoes.show',[ mySlug() , 'TEs'] ) }}">TEs</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('divisoes.show',[ myslug() , 'TEx'] ) }}">TEx</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('divisoes.show',[ mySlug() , 'Cla'] ) }}">Clã</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('divisoes.show',[ mySlug() , 'Chefia'] ) }}">Chefia</a></li>
					</ul>
				</li>
	      		<li class="dropdown">
					<a id="drop1" href="" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> Elementos<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('divisoes.escoteiros',[ mySlug() , 'Alcateia'] ) }}">Alcateia</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('divisoes.escoteiros',[ mySlug() , 'TEs'] ) }}">TEs</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('divisoes.escoteiros',[ myslug() , 'TEx'] ) }}">TEx</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('divisoes.escoteiros',[ mySlug() , 'Cla'] ) }}">Clã</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('divisoes.escoteiros',[ mySlug() , 'Chefia'] ) }}">Chefia</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a id="drop2" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-map-marker"></i> Atividades<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('divisoes.atividades' ,[ mySlug() , 'Alcateia']) }}">Alcateia</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('divisoes.atividades' ,[ mySlug() , 'TEs']) }}">TEs</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('divisoes.atividades' ,[ mySlug() , 'TEx']) }}">TEx</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('divisoes.atividades' ,[ mySlug() , 'Cla']) }}">Clã</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('divisoes.atividades' ,[ mySlug() , 'Chefia']) }}">Chefia</a></li>
						<!--
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('atividades.index' ) }}">Todos</a></li>
						-->
					</ul>
				</li>

				<li class="dropdown">
	          		<a id="drop3" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-th-list"></i> Recursos<span class="caret"></span></a>
	          		<ul class="dropdown-menu" role="menu">
	            		<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('desafios') }}">Cadernos de Progresso</a></li>
	            		<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('objetivos') }}">Objetivos Educativos</a></li>
	            		<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('jogos') }}">Jogos</a></li>
	            		<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('cartaoescoteiro') }} ">Cartão Escoteiro</a></li>
	            		<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('pnec') }} ">Lista Nominal PNEC</a></li>
	            		<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('os') }}">Gerar Ordem de Serviço</a></li>
	          		</ul>
	        	</li>
	    	</ul>
	    	<ul class="nav navbar-nav navbar-right">
	    		@if(Auth::user()->admin == 1)
					<li>
						<a href="{{ URL::to('admin') }}">Admin</a>
					</li>
				@endif
				{!! Form::open(array('route' => ['search',mySlug()] ,'method' => 'POST', 'class' => 'navbar-form navbar-left','role' => 'search')) !!}
	        		<div class="form-group">
	          			<input type="text" class="form-control" name="term" value="{{ isset($term) ? $term : '' }}" placeholder="Procurar Pessoa">
	        		</div>
	    			<button type="submit" class="btn btn-inverse">Procurar</button>
	      		{!! Form::close() !!}
	      		<li class="dropdown">
					<a id="drop1"  role="button" class="dropdown-toggle" data-toggle="dropdown">{{ App\Models\Divisao::getLabel(Auth::user()->divisao) }} <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a tabindex="-1" role="menuitem" href="{{ URL::route('user.mudardivisao',[ mySlug() , App\User::$ALCATEIA]) }}"><span class="{{ Auth::user()->divisao==App\User::$ALCATEIA?'divisao-selected':'' }}">Alcateia</span></a></li>
						<li><a tabindex="-1" role="menuitem" href="{{ URL::route('user.mudardivisao',[ mySlug() , App\User::$TES]) }}"><span class="{{ Auth::user()->divisao==App\User::$TES?'divisao-selected':'' }}">TEs</span></a></li>
						<li><a tabindex="-1" role="menuitem" href="{{ URL::route('user.mudardivisao',[ mySlug() , App\User::$TEX]) }}"><span class="{{ Auth::user()->divisao==App\User::$TEX?'divisao-selected':'' }}">TEx</span></a></li>
						<li><a tabindex="-1" role="menuitem" href="{{ URL::route('user.mudardivisao',[ mySlug() , App\User::$CLA]) }}"><span class="{{ Auth::user()->divisao==App\User::$CLA?'divisao-selected':'' }}">Clã</span></a></li>
						<li><a tabindex="-1" role="menuitem" href="{{ URL::route('user.mudardivisao',[ mySlug() , App\User::$CHEFIA]) }}"><span class="{{ Auth::user()->divisao==App\User::$CHEFIA?'divisao-selected':'' }}">Chefia</span></a></li>
					</ul>
				</li>
		    	<li class="dropdown">
					<a id="drop1"  role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i></a>
					<ul class="dropdown-menu">
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('user.changepassword',mySlug())}}">Mudar Password</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('logout') }}">Logout</a></li>
					</ul>
				</li>
			</ul>
	    </div>

	</div>
</nav>