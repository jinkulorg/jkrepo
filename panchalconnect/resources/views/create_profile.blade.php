@extends('layouts.app')

@section('content')
<div class="grid_3">
    <div class = "container">
        <div class="breadcrumb1">
            <ul>
               <a href="/"><i class="fa fa-home home_1"></i></a>
               <span class="divider">&nbsp;| &nbsp;</span>
               <li class="current-page"><h4>Create Profile </h4></li>
            </ul>
        </div>
            <div class="col_4">
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
			       <ul id="myTab" class="nav nav-tabs nav-tabs1" role="tablist">
			    	  <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">About Myself</a></li>
                      <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Family Details</a></li>
                      <li role="presentation"><a href="#profile1" role="tab" id="profile-tab1" data-toggle="tab" aria-controls="profile1">Review</a></li>
			    	</ul>
                </div>
            </div>

    </div>

</div>
@endsection