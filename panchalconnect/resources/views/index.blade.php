@extends('layouts.app')

@section('content')
<div class="banner">
	<div class="container">
		<div class="banner_info">
			<h3>
				@guest

					Welcome! Guest
				
				@else
				
					Welcome!
					{{ Auth::user()->name }}
					{{ Auth::user()->lastname }}
				
				@endguest
			</h3>

			@guest
			
				<a href="/login" class="hvr-shutter-out-horizontal">Login/Register</a>
			
			@else

				<?php $profile = App\User::find(Auth::user()->id)->profile;
				if ($profile == null) {
					?>
				<a href="{{route('profile.create')}}" class="hvr-shutter-out-horizontal">Create your profile</a>
				<?php
				} else {
					?>
				<a href="{{action('ProfilesController@show',Auth::User()->Profile->id)}}" class="hvr-shutter-out-horizontal">View your profile</a>
				<?php
				}
				?>

			@endguest
		</div>
	</div>
	<div class="profile_search">
		<div class="container wrap_1">
			<form action="">
				<div class="search_top">
					<div class="inline-block">
						<label class="gender_1">I am looking for :</label>
						<div class="age_box1" style="max-width: 100%; display: inline-block;">
							<select>
								<option value="">* Select Gender</option>
								<option value="Male">Bride</option>
								<option value="Female">Groom</option>
							</select>
						</div>
					</div>
					<div class="inline-block">
						<label class="gender_1">Located In :</label>
						<div class="age_box1" style="max-width: 100%; display: inline-block;">
							<select>
								<option value="">* Select State</option>
								<option value="Washington">Washington</option>
								<option value="Texas">Texas</option>
								<option value="Georgia">Georgia</option>
								<option value="Virginia">Virginia</option>
								<option value="Colorado">Colorado</option>
							</select>
						</div>
					</div>
					<div class="inline-block">
						<label class="gender_1">Interested In :</label>
						<div class="age_box1" style="max-width: 100%; display: inline-block;">
							<select>
								<option value="">* Select Interest</option>
								<option value="Sports &amp; Adventure">Sports &amp; Adventure</option>
								<option value="Movies &amp; Entertainment">Movies &amp; Entertainment</option>
								<option value="Arts &amp; Science">Arts &amp; Science</option>
								<option value="Technology">Technology</option>
								<option value="Fashion">Fashion</option>
							</select>
						</div>
					</div>
				</div>
				<div class="inline-block">
					<div class="age_box2" style="max-width: 220px;">
						<label class="gender_1">Age :</label>
						<input class="transparent" placeholder="From:" style="width: 34%;" type="text" value="">&nbsp;-&nbsp;<input class="transparent" placeholder="To:" style="width: 34%;" type="text" value="">
					</div>
				</div>
				<div class="inline-block">
					<label class="gender_1">Status :</label>
					<div class="age_box1" style="max-width: 100%; display: inline-block;">
						<select>
							<option value="">* Select Status</option>
							<option value="Single">Single</option>
							<option value="Married">Married</option>
							<option value="In a Relationship">In a Relationship</option>
							<option value="It's Complicated">It's Complicated</option>
						</select>
					</div>
				</div>
				<div class="submit inline-block">
					<input id="submit-btn" class="hvr-wobble-vertical" type="submit" value="Find Matches">
				</div>
			</form>
		</div>
	</div>
</div>
<div class="grid_1">
	<div class="container">
		<h1>Featured Profiles</h1>
		<div class="heart-divider">
			<span class="grey-line"></span>
			<i class="fa fa-heart pink-heart"></i>
			<i class="fa fa-heart grey-heart"></i>
			<span class="grey-line"></span>
		</div>

		<script type="text/javascript">
			$(window).load(function() {
				$("#flexiselDemo3").flexisel({
					visibleItems: 6,
					animationSpeed: 1000,
					autoPlay: false,
					autoPlaySpeed: 3000,
					pauseOnHover: true,
					enableResponsiveBreakpoints: true,
					responsiveBreakpoints: {
						portrait: {
							changePoint: 480,
							visibleItems: 1
						},
						landscape: {
							changePoint: 640,
							visibleItems: 2
						},
						tablet: {
							changePoint: 768,
							visibleItems: 3
						}
					}
				});

			});
		</script>
		<script type="text/javascript" src="js/jquery.flexisel.js"></script>
	</div>
</div>

@endsection