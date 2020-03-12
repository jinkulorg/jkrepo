@extends('layouts.app')

@section('content')
<div class="banner">
	<div class="container">
		@guest
		@else
			@if (Auth::user()->email_verified_at == null)
			<div class="alert alert-danger">
				<b><i class='fa fa-info-circle' aria-hidden='true'></i>
					Thank you for registering! Before proceeding, please verify your email address to create your profile.</b><br>
					Please check your email for a verification link. If you did not receive the email, <a href="/email/resend">click here to request another.</a>
			</div>
			@endif
		@endguest
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
	<div class="profile_search" >
		<div class="container wrap_1"  style="margin-top: -15px; margin-bottom: -15px">
		<div class="row" style="margin-top: 0px; margin-bottom: 0px">

		<div class="col-md-3 search_left" style="margin-top: 20px; margin-bottom: 0px">
		<form method="post" id="profile_search_form" onsubmit="setAction()">
			@CSRF
			
			<!-- <div class="search_top" > -->
			<div style="margin-top: 10px; margin-bottom: 10px">
				<input type="hidden" name="_method" value="GET" />
				<label class="gender_1" >Search By Id: </label>
					<div class="inline-block">
				  		<div class="age_box1" >
				  			<input class="transparent" type="text" name="profileid" size="15" placeholder="Enter Profile ID" required>
						</div>
					</div>
				</div>
			<!-- </div> -->
			<div style="margin-top: 10px; margin-bottom: 10px">
					<div class="age_box2">
				  <input id="submit-btn" class="hvr-wobble-vertical" type="submit" value="Search">
				</div></div>
      	</form>
		</div>

		<div class="col-md-1">
			<div class="collapse navbar-collapse">
				<div  style="border-left: 1px solid rgb(245, 239, 239); height: 120px; text-align: right; box:sizing: border-box"></div>
			</div>
			<!-- <div class="collapse navbar-collapse" style="text-align: center; color: white; margin-right: -10px; margin-top: 50px; margin-bottom: 50px">
				- OR -
			</div> -->
		<div class="navbar-header nav_2">
			<!-- <button style="margin-left: 10px; margin-top: 0px" type="button" class="btn_1 dropdown-toggle" data-toggle="collapse" >OR
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button> -->
			<div style="text-align: center; color: white;">
				<hr>
			</div>
		</div>
		</div>
		
		<div class="col-md-8 match_right"  style="margin-top: 0px; margin-bottom: 0px">
		<form action="/basicsearch" method="get" >
			@csrf
				<!-- <div class="search_top age_box1" style="text-align: center"> -->
				<div style="margin-top: 10px; margin-bottom: 10px">
					<div class="inline-block">
						<label class="gender_1" >I am looking for :</label>
						<div class="" style="max-width: 100%; display: inline-block;">
							<select name="gender">
								<option value="">--Select Gender--</option>
								<option value="">Male & Female</option>
								<option value="M">Male</option>
								<option value="F">Female</option>
							</select>
						</div>
					</div>
					<div class="inline-block">
						<label class="gender_1">Located In :</label>
						<div class="" style="max-width: 100%; display: inline-block;">
							<select name="present_state">
								<option value="">--Select Location--</option>
								<option value="">Any place</option>
								<?php 
								foreach($allStates as $allstate) {
									?>
									<option value="{{$allstate->present_state}}">{{$allstate->present_country}} - {{$allstate->present_state}}</option>	
									<?php
								}
								?>
							</select>
						</div>
					</div></div>
				<!-- </div> -->
				<div style="margin-top: 10px; margin-bottom: 10px">
					<div class="inline-block">
						<label class="gender_1">Interested In :</label>
						<div class="" style="max-width: 100%; display: inline-block;">
							<select name="hobby">
								<option value="">--Select Interest--</option>
								<option value="">Anything</option>
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
				<div class="inline-block " >
					<div class="" style="max-width: 220px;">
						<label class="gender_1">Age :</label>
						<input name="ageGreaterThan" id="ageGreaterThan" class="transparent" placeholder="From:" style="max-width: 34%;" type="text" value="18" onblur="validateNumber('ageGreaterThan')">&nbsp;-&nbsp;
						<input name="ageLessThan" id="ageLessThan" class="transparent" placeholder="To:" style="max-width: 34%;" type="text" value="40" onblur="validateNumber('ageLessThan')">
					</div>
				</div></div>
				<div style="margin-top: 10px; margin-bottom: 10px">
				<div class="inline-block">
					<label class="gender_1">Status :</label>
					<div class="age_box1" style="max-width: 100%; display: inline-block;">
						<select name="marital_status">
							<option value="">--Select Marital Status--</option>
							<option value="">Any kind</option>
                            <option>Never Married</option>
                            <option>Divorced</option>
                            <option>Widowed</option>
                            <option>Annulled</option>
						</select>
					</div>
				</div>
				<div class="submit inline-block age_box1">
					<input id="submit-btn" class="hvr-wobble-vertical" type="submit" value="Find Matches">
				</div></div>
			</form>
		</div>
		</div>


		</div>
	</div>
</div>
@if(PROMOTE_ENABLED == true)
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
			if ($featuredProfile->profile->status != "ACTIVE") {
				continue;
			}
			$profile_pic_paths = explode(",",$featuredProfile->profile->profile_pic_path);
			$profile_pic_path = ($featuredProfile->profile->profile_pic_path == null || $profile_pic_paths == null || sizeof($profile_pic_paths) == 0) ? "/images/blank-profile-picture.png" : "/storage/profile_images/mainimage/" . $profile_pic_paths[0];
			?>
			<li><div class="col_1"><a href="{{action('ProfilesController@show',$featuredProfile->profile_id)}}">
			<img src="{{$profile_pic_path}}" alt="" class="hover-animation image-zoom-in img-responsive"/>
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
	</div>
</div>
@endif
<div class="grid_1">
	<div class="container">
		<hr>
		<div class="basic_1 alert alert-info" style="display: <?php echo (OFFER_AMOUNT != null) ? "block" : "none"?>; border: 2px solid gray; border-radius: 35px">
			<div style="font-size: 25px; ">
				<h3 style="text-align: center">
					<b style="text-shadow: 4px 4px 8px white, 8px 8px 8px #da8698;">
						<i class="fa fa-star" aria-hidden="true"></i> Short Term Offer <i class="fa fa-star" aria-hidden="true"></i>
					</b>
				</h3>
				<hr>
				<h3 style="text-align: center; line-height: 2em">
					@if(OFFER_FREE == "FREE")
					<b>
						Activate your profile for FREE instead of <s>Rs. {{AMOUNT}}/-</s>
						<br>Free to use panchal connect for six months
						<br>Hurry!! Offer valid till {{OFFER_END_DATE}}
					</b>
					@else
					<b>
						Activate your profile for just Rs. {{OFFER_AMOUNT}}/- instead of <s>Rs. {{AMOUNT}}/-</s> 
						<br>Hurry!! Offer valid till {{OFFER_END_DATE}}
					</b>
					@endif
				</h3>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/jquery.flexisel.js"></script>
<script type="text/javascript">
	$(window).load(function() {
				$("#flexiselDemo3").flexisel({
					visibleItems: 6,
					animationSpeed: 1000,
					autoPlay: true,
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
 function validateNumber(input) {
		var inputValue = document.getElementById(input).value;
		if (isNaN(inputValue)) {
		    alert("Invalid value: " + inputValue + ", Please enter numeric value.");
		    setTimeout(function () {document.getElementById(input).focus();}, 10);
		}
	}

 function setAction() {
    var your_form = document.getElementById('profile_search_form');
    your_form.action = "/profile/" + document.getElementsByName("profileid")[0].value;
  }
</script>
@endsection