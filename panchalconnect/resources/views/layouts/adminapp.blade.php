<!DOCTYPE html>
<!-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> -->

<head>
	<!-- <title>Marital an Wedding Category Flat Bootstarp Resposive Website Template | Home :: w3layouts</title> -->
	<title>{{ config('app.name', 'Laravel') }}</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Marital Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />

	<!-- Scripts -->
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {
			$(".dropdown").hover(
				function() {
					$('.dropdown-menu', this).stop(true, true).slideDown("fast");
					$(this).toggleClass('open');
				},
				function() {
					$('.dropdown-menu', this).stop(true, true).slideUp("fast");
					$(this).toggleClass('open');
				}
			);
		});
	</script>

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Oswald:300,400,700' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
	<!----font-Awesome----->
	<link href="/css/font-awesome.css" rel="stylesheet">
	<!----font-Awesome----->

	<!-- Styles -->
	<link href="/css/bootstrap-3.1.1.min.css" rel='stylesheet' type='text/css' />
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

	<!-- Custom Theme files -->
	<link href="/css/style.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="/css/multiformstyle.css" />

	<!-- Date Picker -->
	<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

	<!-- Javascript -->
	<script>
		$(function() {
			$("#datepicker-3").datepicker({
				appendText: "(YYYY-MM-DD)",
				dateFormat: "yy-mm-dd",
				altField: "#datepicker-4",
				altFormat: "DD, d MM, yy"
			});
		});
	</script>

</head>

<body>
	<!-- ============================  Navigation Start =========================== -->

	<div class="navbar navbar-inverse-blue navbar">
		<!--<div class="navbar navbar-inverse-blue navbar-fixed-top">-->
		<div class="navbar-inner">
			<div class="container">
				<div class="nav pull-right">
					<div class="navigation">
						<nav id="colorNav">
							<ul>
								<li class="green">
									<div class="username">
										<a href="#">
											<label>
												Hi,
												@guest
												<b>Guest</b>
												@else
												<b>{{ Auth::user()->name }} {{ Auth::user()->lastname }} </b>
												@endguest
											</label>
										</a>
									</div>
									<ul>
										@guest
										<li><a href="/login">Login</a></li>
										<li><a href="/register">Register</a></li>
										@else
										<li> <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
												{{ __('Logout') }}
											</a>
											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
											</form>
										</li>
										@endguest
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<a class="brand" href="/"><img src="/images/pclogo.png" alt="logo"></a>
				<div class="pull-right">
					<nav class="navbar nav_bottom" role="navigation">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header nav_2">
							<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">Menu
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="#"></a>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
							<ul class="nav navbar-nav nav_1">
								<li><a href="/">Home</a></li>
								<?php
								if (Auth::user() != null && Auth::user()->isAdmin()) {
									?>
									<li><a href="/admin">Admin Home</a></li>
								<?php
								}
								?>
								<li><a href="/about">About</a></li>
								<li><a href="/advanced_search">Search</a> </li>
								<li><a href="/requests">Requests</a></li>
								<li class="last"><a href="/contact">Contacts</a></li>

							</ul>
						</div><!-- /.navbar-collapse -->
					</nav>
				</div> <!-- end pull-right -->

				<div class="clearfix"> </div>
			</div> <!-- end container -->
		</div> <!-- end navbar-inner -->
	</div> <!-- end navbar-inverse-blue -->
	<!-- ============================  Navigation End ============================ -->
	<br>
	<div class="container" style="background-color: brown">
		<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
			<ul class="nav navbar-nav nav_1">
				<li><a href="/manageuser">Manage User</a></li>
				<li><a href="/manageprofile">Manage Profile</a> </li>
				<li class="last"><a href="/managefeaturedprofile">Manage Featured Profile</a> </li>
			</ul>
		</div>
	</div>
	<main class="py-4">
		@yield('content')
	</main>

	<!-- ============================  Footer Start ============================ -->

	<div class="footer">
		<div class="container">
			<div class="clearfix"> </div>
			<div class="copy">
				<p>Copyright © 2019 Panchal Connect . All Rights Reserved | Design by <a href="http://Jinkul.com/" target="_blank">Jinkul</a> </p>
			</div>
		</div>
	</div>
	<!-- ============================  Footer End ============================ -->
</body>

</html>