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
   <h2>{{ $profile->User->name }} {{ $profile->User->lastname }} ({{$profile->id }})</h2>
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
							<p>Profile id:  {{$profile->id }}</p>
							<p>Gender: {{ $profile->gender == 'F' ? 'Female' : 'Male' }}</p>
							<p>Highest Education : {{$profile->highest_education }} </p>
							<p>Education Details :  {{$profile->education_details}}</p>
						</div>
					</div>
				</div>
		  </div>
	   </div>
   	 </div>
     
  </div>
</div>

<script src="/js/multiform.js"></script>
@endsection