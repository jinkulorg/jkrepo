@extends('layouts.app')

@section('content')
<div class="grid_3">
	<div class="container">
		<div class="breadcrumb1">
			<ul>
				<a href="/"><i class="fa fa-home home_1"></i></a>
				<span class="divider">&nbsp;|&nbsp;</span>
				<li class="current-page">View Profile</li>
			</ul>
		</div>


		<div class="col-md-9 search_left">
			<?php
			if ($isGuest) {
				?> <a href="/login">Login/Register</a>
			<?php
			} else if ($noProfile) {
				?>
				<a href="{{route('profile.create')}}"> Create your profile to send request</a>
				<?php
				} else if ($isSelf) {
					echo "Your Profile";
				} else if ($isSent) {
					echo "Request already sent";
				} else if ($isReceived) {
					echo "Request already received";
				} else {
					$marriedController = new App\Http\Controllers\MarriedController();
					// Checking if logged in user is not married and searched user is also not married. 
					// If any one of them is married, Send request button will not be displayed.
					if (!($marriedController->isMarried(Auth::user()->Profile->id)) and !($marriedController->isMarried($profile->id))) {
						?>
					<form method="post" action="{{url('requestsent')}}">
						@csrf
						<input type="hidden" name="profileid" value="{{$profile->id }}" />
						<input type="submit" value="Send Request" />
					</form>

			<?php
				}
			}
			?>

			<table width=100%>
				<td>
					<h2>{{ $profile->User->name }} {{ $profile->User->lastname }} (Profile Number: {{$profile->id }}) </h2>
				</td>
				<?php
				if ($isSelf || Auth::user()->isAdmin()) {
					?>
					<td align="right">
						<h4><a href="{{action('ProfilesController@edit',$profile->id)}}">Edit Profile</a></h4>
					</td>
				<?php
				}
				?>
			</table>
			<div class="col_4">
				<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs nav-tabs1" role="tablist">
						<li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">About Myself</a></li>
						<li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Family Details</a></li>
						<li role="presentation"><a href="#profile1" role="tab" id="profile-tab1" data-toggle="tab" aria-controls="profile1">Partner Preference</a></li>

					</ul>
					<div class="basic_1">
						<div class="col-md-12 basic_1_left">
							<!--------------------About Myself & Life Cycle------------------------------->
							<div class="tab">
								<h3>About Myself</h3>
								<p>Profile id: {{$profile->id }}</p>
								<p>Gender: {{ $profile->gender == 'F' ? 'Female' : 'Male' }}</p>
								<p>Highest Education : {{$profile->highest_education }} </p>
								<p>Education Details : {{$profile->education_details}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 match_right">
			<div class="profile_search1">
				<form method="post" id="profile_search_form" onsubmit="setAction()">
					@CSRF
					<input type="hidden" name="_method" value="GET" />
					Search By Id: <input type="text" class="m_1" name="searchprofileid" size="30" placeholder="Enter Profile ID">
					<input type="submit" value="Go">
				</form>
			</div>
			<section class="slider">

			</section>
			<div class="view_profile view_profile2">
				<h3>Recently Viewed Profiles</h3>
				<?php
				$user = Auth::user();
				if ($user != null) {
					$loginprofile = $user->profile;
					if ($loginprofile != null) {
						$viewedProfiles = $loginprofile->recently_viewed_profiles;
						if ($viewedProfiles != null) {
							$profileIdList = explode(",", $viewedProfiles);
							foreach ($profileIdList as $viewedProfileId) {
								$viewedProfile = App\Profile::find($viewedProfileId);
								$heights = explode(".", $viewedProfile->height);
								?>
								<ul class="profile_item">
									<a href="{{action('ProfilesController@show',$viewedProfile->id)}}">
										<li class="profile_item-img">
											<img src="images/p5.jpg" class="img-responsive" alt="" />
										</li>
										<li class="profile_item-desc">
											<h4>{{$viewedProfile->id}}</h4>
											<p>{{$viewedProfile->user->name}} {{$viewedProfile->user->lastname}}</p>
											<p>{{$viewedProfile->age()}} Yrs, {{$heights[0]}}Ft {{$heights[1]}}in</p>
											<h5>View Full Profile</h5>
										</li>
										<div class="clearfix"> </div>
									</a>
								</ul>
				<?php
							}
						}
					}
				}
				?>
			</div>
		</div>
	</div>
</div>

<script src="/js/multiform.js"></script>
<script type="text/javascript">
  function setAction() {
    var your_form = document.getElementById('profile_search_form');
    your_form.action = "/profile/" + document.getElementsByName("searchprofileid")[0].value;
  }
</script>
@endsection