<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::to('dashboard') }}">{{ mySlug() }}</a>
    </div>
    <!-- /.navbar-header -->

    <!-- TOP MENU -->
    <ul class="nav navbar-top-links navbar-right">
    	<li class="dropdown">
			<a id="drop1"  role="button" class="dropdown-toggle" data-toggle="dropdown">{{ App\Models\Divisao::getLabel(Auth::user()->divisao) }} <span class="fa fa-caret-down"></span></a>
			<ul class="dropdown-menu">
				<li><a href="{{ URL::route('user.mudardivisao',[ mySlug() , App\User::$ALCATEIA]) }}"><span class="{{ Auth::user()->divisao==App\User::$ALCATEIA?'divisao-selected':'' }}">Alcateia</span></a></li>
				<li><a href="{{ URL::route('user.mudardivisao',[ mySlug() , App\User::$TES]) }}"><span class="{{ Auth::user()->divisao==App\User::$TES?'divisao-selected':'' }}">TEs</span></a></li>
				<li><a href="{{ URL::route('user.mudardivisao',[ mySlug() , App\User::$TEX]) }}"><span class="{{ Auth::user()->divisao==App\User::$TEX?'divisao-selected':'' }}">TEx</span></a></li>
				<li><a href="{{ URL::route('user.mudardivisao',[ mySlug() , App\User::$CLA]) }}"><span class="{{ Auth::user()->divisao==App\User::$CLA?'divisao-selected':'' }}">Clã</span></a></li>
				<li><a href="{{ URL::route('user.mudardivisao',[ mySlug() , App\User::$CHEFIA]) }}"><span class="{{ Auth::user()->divisao==App\User::$CHEFIA?'divisao-selected':'' }}">Chefia</span></a></li>
			</ul>
		</li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
            	@if(Auth::user()->getEscoteiroId() > 0)
                	<li><a href="{{ URL::route('escoteiros.show',[mySlug(),Auth::user()->getEscoteiroId()]) }}"><i class="fa fa-user fa-fw"></i> Perfil Escoteiro</a></li>
                @endif
                <li><a href="{{ URL::route('user.changepassword',mySlug())}}"><i class="fa fa-gear fa-fw"></i> Mudar password</a>
                </li>
                <li class="divider"></li>
                	<li><a href="{{ URL::to('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <!-- SIDE MENU -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                	{!! Form::open(array('route' => ['search',mySlug()] ,'method' => 'POST', 'role' => 'search')) !!}
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" name="term" value="{{ isset($term) ? $term : '' }}" placeholder="Procurar Pessoa...">
                        <span class="input-group-btn">
                        <button class="form-control btn btn-default" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                    {!! Form::close() !!}
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="{{ URL::to('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <!-- DIVISAO -->
                <li>
					<a href="#menu_divisao"><i class="glyphicon glyphicon-folder-open"></i> Divisão<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li><a href="{{ URL::route('divisoes.show',[ mySlug() , 'Alcateia'] ) }}">Alcateia</a></li>
						<li><a href="{{ URL::route('divisoes.show',[ mySlug() , 'TEs'] ) }}">TEs</a></li>
						<li><a href="{{ URL::route('divisoes.show',[ myslug() , 'TEx'] ) }}">TEx</a></li>
						<li><a href="{{ URL::route('divisoes.show',[ mySlug() , 'Cla'] ) }}">Clã</a></li>
						<li><a href="{{ URL::route('divisoes.show',[ mySlug() , 'Chefia'] ) }}">Chefia</a></li>
					</ul>
				</li>
				<!-- Elementos -->
				<li>
					<a href="#menu_elementos"><i class="glyphicon glyphicon-user"></i> Elementos<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li><a href="{{ URL::route('divisoes.escoteiros',[ mySlug() , 'Alcateia'] ) }}">Alcateia</a></li>
						<li><a href="{{ URL::route('divisoes.escoteiros',[ mySlug() , 'TEs'] ) }}">TEs</a></li>
						<li><a href="{{ URL::route('divisoes.escoteiros',[ myslug() , 'TEx'] ) }}">TEx</a></li>
						<li><a href="{{ URL::route('divisoes.escoteiros',[ mySlug() , 'Cla'] ) }}">Clã</a></li>
						<li><a href="{{ URL::route('divisoes.escoteiros',[ mySlug() , 'Chefia'] ) }}">Chefia</a></li>
					</ul>
				</li>
				<!-- Atividades -->
				<li>
					<a href="#menu_atividades"><i class="glyphicon glyphicon-map-marker"></i> Atividades<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li><a href="{{ URL::route('divisoes.atividades' ,[ mySlug() , 'Alcateia']) }}">Alcateia</a></li>
						<li><a href="{{ URL::route('divisoes.atividades' ,[ mySlug() , 'TEs']) }}">TEs</a></li>
						<li><a href="{{ URL::route('divisoes.atividades' ,[ mySlug() , 'TEx']) }}">TEx</a></li>
						<li><a href="{{ URL::route('divisoes.atividades' ,[ mySlug() , 'Cla']) }}">Clã</a></li>
						<li><a href="{{ URL::route('divisoes.atividades' ,[ mySlug() , 'Chefia']) }}">Chefia</a></li>
					</ul>
				</li>
                <!-- Material -->
                <li>
                    <a href="#menu_material"><i class="glyphicon glyphicon-briefcase"></i> Material<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ URL::route('divisoes.material' ,[ mySlug() , 'Alcateia']) }}">Alcateia</a></li>
                        <li><a href="{{ URL::route('divisoes.material' ,[ mySlug() , 'TEs']) }}">TEs</a></li>
                        <li><a href="{{ URL::route('divisoes.material' ,[ mySlug() , 'TEx']) }}">TEx</a></li>
                        <li><a href="{{ URL::route('divisoes.material' ,[ mySlug() , 'Cla']) }}">Clã</a></li>
                        <li><a href="{{ URL::route('divisoes.material' ,[ mySlug() , 'Chefia']) }}">Chefia</a></li>
                        <li><a href="{{ URL::route('divisoes.material' ,[ mySlug() , 'Grupo']) }}">Grupo</a></li>
                    </ul>
                </li>
				<!-- Recursos -->
				<li>
	          		<a href="#"><i class="glyphicon glyphicon-th-list"></i> Recursos<span class="fa arrow"></span></a>
	          		<ul class="nav nav-second-level">
	            		<li><a href="{{ URL::to('desafios') }}">Cadernos de Progresso</a></li>
	            		<li><a href="{{ URL::to('objetivos') }}">Objetivos Educativos</a></li>
	            		<li><a href="{{ URL::to('jogos') }}">Jogos</a></li>
	            		<li><a href="{{ URL::to('cartaoescoteiro') }} ">Cartão Escoteiro</a></li>
	            		<li><a href="{{ URL::to('pnec') }} ">Lista Nominal PNEC</a></li>
	            		<li><a href="{{ URL::to('os') }}">Gerar Ordem de Serviço</a></li>
	          		</ul>
	        	</li>
	        	<!-- ADMIN -->
	        	@if(Auth::user()->admin == 1)
					<li>
						<a href="{{ URL::to('admin') }}">Admin</a>
					</li>
				@endif
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>