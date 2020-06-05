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
    @elseif (Auth()->user()->Profile->status != 'ACTIVE')
      Please <a class='vertical' href="/activate">activate</a> your profile to use this feature
    @else
    <div class="col-md-9 search_left">
      <table width=100%>
        <td>
        <div class="basic_1">
          <h3 class="profile_title" style="margin: 5px; padding: 5px;"><b>{{ Auth::user()->name }} {{ Auth::user()->lastname }} References </b></h3>
        </div>
        </td>
        <td>
          <div class="basic_1">
          <h4 style="text-align: right;"><a class="btn_2" href="/reference">Manage your References</a></h4>
</div>
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
        <input class="btn_1" type="submit" value="Find Profiles With Mutual Reference" />
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
          Search By Id: <input type="text" class="m_1" name="profileid" size="30" placeholder="Enter Profile ID" required>
          <input type="submit" value="Go">
        </form>
      </div>
      <section class="slider">

      </section>
      <a href="https://www.bluehost.com/track/cooldeep/panchalconnect" target="_blank">
                        <img border="0" src="https://bluehost-cdn.com/media/partner/images/cooldeep/300x250/300x250BW.png">
                        </a>
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
                if ($viewedProfile != null) {
                if ($viewedProfile->profile_pic_path != null) {
                  $profile_pics = explode(",", $viewedProfile->profile_pic_path);
                }
                $heights = explode(".", $viewedProfile->height);
                ?>
                <ul class="profile_item">
                  <a href="{{action('ProfilesController@show',$viewedProfile->id)}}">
                    <li class="profile_item-img">
                      <img src="<?php echo ($viewedProfile->profile_pic_path != null && sizeof($profile_pics) != 0) ? "/storage/profile_images/thumbnail/" . $profile_pics[0] : "/images/blank-profile-picture.png"; ?>" class="img-responsive" alt="" />
                    </li>
                    <li class="profile_item-desc">
                      <h4>{{$viewedProfile->id}}</h4>
                      <p>{{$viewedProfile->user->name}} {{$viewedProfile->user->lastname}}</p>
                      <p>{{$viewedProfile->age()}} Yrs, {{($viewedProfile->height != null && sizeof($heights) >= 1) ? $heights[0] : "0"}} Ft {{($viewedProfile->height != null && sizeof($heights) == 2) ? $heights[1] : "0" }} In</p>
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