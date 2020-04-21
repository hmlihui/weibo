<!DOCTYPE html>
<html>
  <head>

    <title>@yield('title', 'Weibo App') - Laravel 新手入门教程</title>

    <link rel="stylesheet" type="text/css" href="/css/app.css">

  </head>
  <body>
  	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  		<div class="container">
  			<a class="navbar-brand" href="/">weibo App</a>
  			<ul class="navbar-nav justify-content-end">
  				<li class="nav-item">
  					<a class="nav-link" href="/help">帮助</a>
  				</li>
  				<li>
  					<a class="nav-link" href="#">登录</a>
  				</li>
  			</ul>
  		</div>
  	</nav>
  	<div class="container">
  		   @yield('content')
  	</div>

  </body>
</html>