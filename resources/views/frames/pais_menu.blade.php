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
	      <a class="navbar-brand" href="{{ URL::to('dashboard') }}">Início</a>
	    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    	<ul class="nav navbar-nav">
	    		
	      	</ul>
	      
	      <ul class="nav navbar-nav navbar-right">
	        <li class="dropdown">
				<a id="drop1"  role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i></a>
				<ul class="dropdown-menu">
					<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('user.changepassword',mySlug())}}">Mudar Password</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('logout') }}">Logout</a></li>
				</ul>
			</li>
	    </ul>
	    </div><!-- /.navbar-collapse -->
  	</div><!-- /.container-fluid -->
</nav>