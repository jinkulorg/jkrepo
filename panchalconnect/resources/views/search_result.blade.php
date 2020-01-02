@extends('layouts.app')

@section('content')
<div class="grid_3">
    <div class="container">
        <div class="breadcrumb1">
            <ul>
                <a href="/"><i class="fa fa-home home_1"></i></a>
                <span class="divider">&nbsp;|&nbsp;</span>
                <li class="current-page">Search Result</li>
            </ul>

            <div class="col-md-9 search_left">
                <br>
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="alert alert-success">
                    <?php
                    echo sizeof($filteredProfiles) . " records found <br>";
                    ?>
                </div>
                <hr><br>
                @foreach ($filteredProfiles as $profile)
                Profile id: {{$profile->id}} <br>
                Last seen: {{$profile->user->last_login_date}}<br>
                Name: {{$profile->user->name}} {{$profile->user->lastname}} <br>
                Designation: {{$profile->designation}} <br>
                Age: {{$profile->age()}} <br>
                status: {{$profile->marital_status}} <br>
                Shani: {{$profile->shani}}<br>
                Mangal: {{$profile->mangal}}<br>
                Annual Income: {{$profile->annual_income}}
                <hr>
                @endforeach
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
</div>

<script type="text/javascript">
  function setAction() {
    var your_form = document.getElementById('profile_search_form');
    your_form.action = "/profile/" + document.getElementsByName("profileid")[0].value;
  }
</script>
@endsection