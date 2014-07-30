<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	
	<title>DD Tools</title

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	
	{{ HTML::style('/assets/resources/bootstrap-3.2.0-dist/css/bootstrap.min.css') }}
	{{ HTML::style('http://maxcdn.bootstrapcdn.com/bootswatch/3.2.0/superhero/bootstrap.min.css') }}
	{{ HTML::style('/assets/css/main.css') }}

	@yield('styles')

	<link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('/') }}/favicon.ico">
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>	
	<style>
	h2{
		background-color: #000;
	}
	</style>
</head>
<body>

	<div id="page">

		<nav id="nav_main" class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
				    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main">
				      <span class="sr-only">Toggle navigation</span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				    </button>
				</div>

				<div class="collapse navbar-collapse" id="navbar-collapse-main">
					<ul class="nav navbar-nav navbar-right">
						@if(!$user)
						<li class="login"><a href="{{ URL::to('login') }}"><span class="glyphicon glyphicon-lock"></span> Login</a></li>
						@else
						<li class="account dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> My Account <b class="caret"></b></a>
							<ul class="dropdown-menu">
					          <li class="{{ menuActive('dashboard') }}"><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
					          <li class="{{ menuActive('profile') }}"><a href="{{ URL::to('profile') }}">My Profile</a></li>
					          <li class="{{ menuActive('campaigns') }}"><a href="{{ URL::to('campaigns') }}">My Campaigns</a></li>
					          <li class="{{ menuActive('characters') }}"><a href="{{ URL::to('characters') }}">My Characters</a></li>
					          <li class="divider"></li>
					          <li><a href="{{ URL::to('logout') }}">Logout</a></li>
					        </ul>
						</li>
						@endif

						@if($isAdmin)
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Admin <b class="caret"></b></a>
							<ul class="dropdown-menu">
					          <li class="{{ menuActive('admin/users') }}"><a href="{{ URL::to('admin/users') }}">Manage Users</a></li>
					          <li class="{{ menuActive('admin/campaigns') }}"><a href="{{ URL::to('admin/campaigns') }}">Manage Campaigns</a></li>
					          <li class="{{ menuActive('admin/characters') }}"><a href="{{ URL::to('admin/characters') }}">Manage Characters</a></li>
					        </ul>
						</li>
						@endif

					</ul>
				</div>
				
			</div>
		</nav>

		<header id="header">

		</header>
		
		<div id="main">
			<div class="container">
				@if(alerts_exist())
					@foreach (alerts_get() as $alert)
					<div class="alert alert-{{ $alert['type'] }}">{{ $alert['message'] }}</div>
					@endforeach
				@endif
			</div>
			<div id="content" class="" role="main">
				@yield('content')		
			</div><!-- /#content -->
		</div>
		<footer id="footer">
			
		</footer>
	</div>
	{{ HTML::script('/assets/resources/jquery-2.1.1.min.js') }}
	{{ HTML::script('/assets/resources/bootstrap-3.2.0-dist/js/bootstrap.min.js') }}
	{{ HTML::script('/assets/js/main.js') }}

	@yield('scripts')



</body>
</html>