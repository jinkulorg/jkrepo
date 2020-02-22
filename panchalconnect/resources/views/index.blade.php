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

			<form action="/basicsearch" method="get" >
			@csrf
				<div class="search_top">
					<div class="inline-block">
						<label class="gender_1">I am looking for :</label>
						<div class="age_box1" style="max-width: 100%; display: inline-block;">
							<select name="gender">
								<option value="">--Select Gender--</option>
								<option value="M">Male</option>
								<option value="F">Female</option>
							</select>
						</div>
					</div>
					<div class="inline-block">
						<label class="gender_1">Located In :</label>
						<div class="age_box1" style="max-width: 100%; display: inline-block;">
							<select name="present_state">
								<option value="">--Select State--</option>
								<?php 
								foreach($allStates as $allstate) {
									?>
									<option value="{{$allstate->present_state}}">{{$allstate->present_country}} - {{$allstate->present_state}}</option>	
									<?php
								}
								?>
							</select>
						</div>
					</div>
					<div class="inline-block">
						<label class="gender_1">Interested In :</label>
						<div class="age_box1" style="max-width: 100%; display: inline-block;">
							<select name="hobby">
								<option value="">--Select Interest--</option>
								<?php 
								foreach($allHobbies as $allhobby) {
									?>
									<option value="{{$allhobby->hobby}}">{{$allhobby->hobby}}</option>	
									<?php
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="inline-block">
					<div class="age_box2" style="max-width: 220px;">
						<label class="gender_1">Age :</label>
						<input name="ageGreaterThan" id="ageGreaterThan" class="transparent" placeholder="From:" style="width: 34%;" type="text" value="0" onblur="validateNumber('ageGreaterThan')">&nbsp;-&nbsp;
						<input name="ageLessThan" id="ageLessThan" class="transparent" placeholder="To:" style="width: 34%;" type="text" value="100" onblur="validateNumber('ageLessThan')">
					</div>
				</div>
				<div class="inline-block">
					<label class="gender_1">Status :</label>
					<div class="age_box1" style="max-width: 100%; display: inline-block;">
						<select name="marital_status">
							<option value="">--Select Marital Status--</option>
                            <option>Never Married</option>
                            <option>Divorced</option>
                            <option>Widowed</option>
                            <option>Annulled</option>
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
		<ul id="flexiselDemo3">
		<?php
		foreach($featuredProfiles as $featuredProfile) { 
			$profile_pic_paths = explode(",",$featuredProfile->profile->profile_pic_path);
			$profile_pic_path = ($profile_pic_paths == null || sizeof($profile_pic_paths) == 0) ? "" : $profile_pic_paths[0];
			?>
			<li><div class="col_1"><a href="{{action('ProfilesController@show',$featuredProfile->profile_id)}}">
			<img src="/storage/profile_images/{{$profile_pic_path}}" alt="" class="hover-animation image-zoom-in img-responsive"/>
			 <div class="layer m_1 hidden-link hover-animation delay1 fade-in">
				<div class="center-middle">
				<?php 
					if ($featuredProfile->Profile->gender == 'M') 
					{ 
				?>	
				About Him
				<?php 
					} else { 
				?>
				About Her
				<?php
					}
				?>
				</div>
			 </div>
			 <h3><span class="m_3">Profile ID : {{$featuredProfile->profile_id}}</span><br>{{$featuredProfile->Profile->user->name}} {{$featuredProfile->Profile->user->lastname}} - {{$featuredProfile->Profile->present_country}}<br>{{$featuredProfile->Profile->designation}}</h3></a></div>
		  </li>
		<?php }
		?>
		</ul>
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
<script type="text/javascript">
 function validateNumber(input) {
		var inputValue = document.getElementById(input).value;
		if (isNaN(inputValue)) {
		    alert("Invalid value: " + inputValue + ", Please enter numeric value.");
		    setTimeout(function () {document.getElementById(input).focus();}, 10);
		}
	}
</script>
@endsection