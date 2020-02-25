@extends('layouts.app')

@section('content')
<div class="grid_3">
  <div class="container">
    <div class="breadcrumb1">
      <ul>
        <a href="/"><i class="fa fa-home home_1"></i></a>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page">Reference Based Search</li>
      </ul>
    </div>
    @if (Auth()->user() == null)
      Please <a href='/login'>Login/Register</a> to use this feature
    @elseif (Auth()->user()->Profile == null)
      Please <a class='vertical' href=" . route('profile.create') . ">create</a> your profile to use this feature
    @else
    <div class="col-md-9 search_left">
      <table width=100%>
        <td>
          <h3>{{ Auth::user()->name }} {{ Auth::user()->lastname }} References </h3>
        </td>
        <td align="right">
          <h4><a href="/reference">Manage your References</a></h4>
        </td>
      </table>
      <div class="table-responsive">
        <table class="table table-striped">
          <tr>
            <th>First Name</th>
            <th>Second Name</th>
            <th>Last Name</th>
            <th>Relation</th>
            <th>City</th>
            <th>State</th>
            <th>Pincode</th>
          </tr>
          @foreach($references as $reference)
          <tr>
            <td>{{$reference['first_name']}}</td>
            <td>{{$reference['second_name']}}</td>
            <td>{{$reference['last_name']}}</td>
            <td>{{$reference['relation']}}</td>
            <td>{{$reference['city']}}</td>
            <td>{{$reference['state']}}</td>
            <td>{{$reference['pincode']}}</td>
          </tr>
          @endforeach
        </table>
      </div>
      <hr>
      <p>
        Based on your above references, you can find other profiles having mutual reference.
        There may be other profiles having same references as you have.
        To find such profiles click on below button, "Find Profiles With Mutual Reference".<br>

      </p>
      <br>
      <form method="get" action="/reference_search">
        @csrf
        <input type="submit" value="Find Profiles With Mutual Reference" />
      </form>
      <br>
      <p>
        If you do not find any profile then try to add as many references as possible so that you can find some one.
        To add, update or delete your references you can click on "Manage your References".
      </p>
      <br>
      Note: Keep checking this everyday, because new profiles are registered everyday and existing profiles can add their references anytime.
      So, there would be high chance that you can find some profile having mutual reference.
    </div>
    <div class="col-md-3 match_right">
      <div class="profile_search1">
        <form method="post" id="profile_search_form" onsubmit="setAction()">
          @CSRF
          <input type="hidden" name="_method" value="GET" />
          Search By Id: <input type="text" class="m_1" name="profileid" size="30" placeholder="Enter Profile ID">
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
                if ($viewedProfile->profile_pic_path != null) {
                  $profile_pics = explode(",", $viewedProfile->profile_pic_path);
                }
                $heights = explode(".", $viewedProfile->height);
                ?>
                <ul class="profile_item">
                  <a href="{{action('ProfilesController@show',$viewedProfile->id)}}">
                    <li class="profile_item-img">
                    <img src="<?php if ($viewedProfile->profile_pic_path != null) {?>/storage/profile_images/thumbnail/{{$profile_pics[0]}} <?php } ?>" class="img-responsive" alt="" />
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
    @endif
    <div class="clearfix"> </div>
  </div>
</div>


<script type="text/javascript">
  function setAction() {
    var your_form = document.getElementById('profile_search_form');
    your_form.action = "/profile/" + document.getElementsByName("profileid")[0].value;
  }
</script>
@endsection