<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::to('dashboard') }}">Início</a>
    </div>
    <!-- /.navbar-header -->

    <!-- TOP MENU -->
    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="{{ URL::route('user.changepassword',mySlug())}}"><i class="fa fa-gear fa-fw"></i> Mudar password</a>
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
                <li>
                    <a href="{{ URL::route('escoteiros.show' , [mySlug(),App\Models\Escoteiro::getRealId(Auth::user()->escoteiro_id)] ) }}"><i class="glyphicon glyphicon-user"></i> Perfil</b></a>
                </li>
                <li>
                    <a href="{{ URL::route('escoteiros.showprogresso' , [mySlug(),App\Models\Escoteiro::getRealId(Auth::user()->escoteiro_id)] ) }}"><i class="glyphicon glyphicon-check"></i> Progresso</b></a>
                </li>
                <li>
                    <a href="{{ URL::to('desafios') }}"><i class="glyphicon glyphicon-list-alt"></i> Cadernos</b></a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>