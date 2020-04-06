<!DOCTYPE html>
<!-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> -->

<head>
	<title>{{ config('app.name', 'Panchal Connect') }} - The matrimonial platform to connect panchal community</title>
	<!-- add icon link -->
	<link rel="icon" href="/images/pclogoicon.png" type="image/x-icon">
		
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Marital Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
	<meta name="GENERATOR" content="Evrsoft First Page">
	
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!----font-Awesome----->

	<!-- Styles -->
	<link href="/css/bootstrap-3.1.1.min.css" rel='stylesheet' type='text/css' />
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

	<!-- Custom Theme files -->
	<link href="/css/style2.css" rel='stylesheet' type='text/css' />
	<link href="/css/style.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="/css/multiformstyle.css" />

	<!-- Date Picker -->
	<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

	<!-- FlexSlider -->
	<script defer src="/js/jquery.flexslider.js"></script>
	<link rel="stylesheet" href="/css/flexslider.css" type="text/css" media="screen" />

	<!-- Javascript -->
	<script>
		$(function() {
			$("#datepicker-3").datepicker({
				appendText: "(YYYY-MM-DD)",
				dateFormat: "yy-mm-dd",
				altField: "#datepicker-4",
				altFormat: "DD, d MM, yy",
				changeMonth:true,
				changeYear:true,
				yearRange: 'c-60:c+2',
				showAnim: "slideDown",
				showOn:"button",
                buttonImage: "/images/calender.png",
			    buttonImageOnly: true,
			    showMonthAfterYear: true
			});
		});
	</script>
	<link href="/css/bell-notification.css" rel="stylesheet">

</head>

<body>
	<!-- ============================  Navigation Start =========================== -->

	<div class="navbar navbar-inverse-blue navbar">
		<!--<div class="navbar navbar-inverse-blue navbar-fixed-top">-->
		<div class="navbar-inner">
			<div class="container"  style="width: 80%">
					<a class="brand" href="/"><img src="/images/pclogo.png" alt="logo"></a>
					<div class="nav pull-right">
					<div class="navigation collapse navbar-collapse" >
						<nav id="colorNav" style="padding-right: 90px;">
							<ul>
								<li class="green">
									<div class="username">
										<a href="#">
											<label>
												Hi,
												@guest
												<b>Guest</b>
												@else
												<b>{{ Auth::user()->name }}</b>
												@endguest
											</label>
										</a>
									</div>
									
									<ul>
										@guest
											<li><a href="/login">Login</a></li>
											<li><a href="/register">Register</a></li>
										@else
											<li><a href="/account">My Account</a></li>
											<li><a href="<?php echo (Auth::User()->profile != null) ? action('ProfilesController@show',Auth::User()->profile->id) : '#'?>">My Profile</a></li>
											<li><a href="/reference">My References</a></li>
											<li><a href="/activate">Activate Profile</a></li>
											@if(PROMOTE_ENABLED == true)
											<li><a href="/featuredprofile">Promote Profile</a></li>
											@endif
											<li><a href="/married">Got Married</a></li>
											@if(AFFILIATE_ENABLED == true)
											<li><a href="/affiliate">Affiliate Program</a></li>
											@endif
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
				
				<div class="pull-right">
					<nav class="navbar nav_bottom" role="navigation">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header nav_2">
							<div class="basic_1" style="text-align: center; margin-bottom: 0px; margin-top: 5px;">
								<h3>
									Hi,
									@guest
									<b>Guest</b>
									@else
									<b>{{ Auth::user()->name }}</b>
									@endguest
								</h3>
							</div>
							<button style="margin-left: 10px; margin-top: 0px" type="button" class="btn_1 dropdown-toggle" data-toggle="collapse" data-target="#bs-megadropdown-tabs" >Menu
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							
							<button style="margin-top: -12px" type="button" class="navbar-toggle collapsed navbar-toggle1 " data-toggle="collapse" data-target="#bs-megadropdown-tabs2" >
								<ul id="colorNav">
									<li class="green">
									</li>
								</ul>
							<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<!-- <a class="navbar-brand" href="#"></a> -->
							<div class="collapse navbar-collapse" id="bs-megadropdown-tabs2">
									<ul class="nav navbar-nav nav_1">
										@guest
											<li><a href="/login">Login</a></li>
											<li><a href="/register">Register</a></li>
										@else
											<li><a href="/account">My Account</a></li>
											<li><a href="<?php echo (Auth::User()->profile != null) ? action('ProfilesController@show',Auth::User()->profile->id) : '#'?>">My Profile</a></li>
											<li><a href="/reference">My References</a></li>
											<li><a href="/activate">Activate Profile</a></li>
											@if(PROMOTE_ENABLED == true)
											<li><a href="/featuredprofile">Promote Profile</a></li>
											@endif
											<li><a href="/married">Got Married</a></li>
											@if(AFFILIATE_ENABLED == true)
											<li><a href="/affiliate">Affiliate Program</a></li>
											@endif
											<li> <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
												{{ __('Logout') }}
											</a>
											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
											</form>
										<!-- </li> -->
										@endguest
									</ul>
								</div>
							
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
								<li class="dropdown">
		              				<a href="#" class="dropdown-toggle">Search<span class="caret"></span></a>
		              				<ul class="dropdown-menu" role="menu">
										<li><a href="/advanced_search_open">Advanced Search</a> </li>
										<li><a href="/reference_search_open">Reference Based Search</a> </li>
		            				</ul>
		            			</li>	
								<li><a href="/requests" class="notification">
									<span>Requests</span>
  									<span id="notificationCount" class="badge"><?php echo (Auth()->User()!=null && Auth()->User()->Profile!= null) ? Auth()->User()->Profile->Request_received->where('status','=','NEW')->count() : "0"; ?></span>
								</a></li>
								<li><a href="/about">About</a></li>
								<li class="last"><a href="/contact">Contact</a></li>

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
		<nav class="navbar nav_bottom" role="navigation">
			<div class="navbar-header nav_2">
				<button style="margin-left: 10px; margin-top: 0px" type="button" class="btn_1 dropdown-toggle" data-toggle="collapse" data-target="#bs-megadropdown-tabs-admin" >Admin Menu
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="bs-megadropdown-tabs-admin">
				<ul class="nav navbar-nav nav_1">
					<li><a href="/admin">Dashboard</a></li>
					<li><a href="/adminsearch">Search</a></li>
					<li><a href="/manageuser">Manage User</a></li>
					<li><a href="/manageprofile">Manage Profile</a> </li>
					<li><a href="/managefeaturedprofile">Manage Featured Profile</a> </li>
					<li class="last"><a href="/getAllNewRequestReceived">New Request Received</a> </li>
				</ul>
			</div>
		</nav>
	</div>
	<main class="py-4">
		@yield('content')
	</main>

	<!-- ============================  Footer Start ============================ -->

	<div class="footer">
		<div class="container">
			<div class="clearfix"> </div>
			<div class="copy">
				<p>Copyright © 2019 Panchal Connect . All Rights Reserved | Design by <a href="http://Jinkul.com/" target="_blank">Jinkal Panchal</a> </p>
			</div>
		</div>
	</div>
	<!-- ============================  Footer End ============================ -->
</body>

</html>