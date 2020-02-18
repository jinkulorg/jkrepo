@extends('layouts.app')

@section('content')
<div class="grid_3">
    <div class="container">
        <div class="breadcrumb1">
            <ul>
                <a href="/"><i class="fa fa-home home_1"></i></a>
                <span class="divider">&nbsp;|&nbsp;</span>
                <li class="current-page">Matches Result</li>
            </ul>
        </div>

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
                echo $filteredProfiles->total() . " matches found <br>";
                ?>
            </div>
            <hr><br>
            @foreach ($filteredProfiles as $profile)
            <!-- Profile id: {{$profile->id}} <br>
                    Last seen: {{$profile->user->last_login_date}}<br>
                    Name: {{$profile->user->name}} {{$profile->user->lastname}} <br>
                    Designation: {{$profile->designation}} <br>
                    Age: {{$profile->age()}} <br>
                    status: {{$profile->marital_status}} <br>
                    Shani: {{$profile->shani}}<br>
                    Mangal: {{$profile->mangal}}<br>
                    Annual Income: {{$profile->annual_income}} -->
            <?php
            $profile_pic_paths = [];
            $profile_pic_paths[0] = "#";
            if ($profile->profile_pic_path != null) {
                $profile_pic_paths = explode(",", $profile->profile_pic_path);
            }

            $description = $profile->self_description;
            if (strlen($profile->self_description) > 80) {
                $description = substr($profile->self_description, 0, 80);
            }

            $heights = explode(".", $profile->height);
            if (sizeof($heights) == 0) {
                $heights[0] = 0;
                $heights[1] = 0;
            } else if (sizeof($heights) == 1) {
                $heights[1] = 0;
            }

            $date1 = date_create(date("Y/m/d"));
            $date2 = date_create($profile->user->last_login_date);
            $diff = date_diff($date1, $date2);
            if ($diff->format("%a") == 0) {
                $lastSeen = "Today";
            } else if ($diff->format("%a") == 1) {
                $lastSeen = $diff->format("%a day");
            } else {
                $lastSeen = $diff->format("%a days");
            }

            $searchController = new App\Http\Controllers\SearchController();
            $mutualReferences = $searchController->getMutualReference($profile->id);
            ?>
            <div class="profile_top">
                <h2>{{$profile->id}} | {{$profile->user->name}} {{$profile->user->lastname}}</h2>
                <div class="row">
                    <div class="col-sm-3 profile_left-top">
                        <img src="/storage/profile_images/{{$profile_pic_paths[0]}}" class="img-responsive" alt="" />

                    </div>
                    <div class="col-sm-3">
                        <ul class="login_details1">
                            <li>Last Seen: {{$lastSeen}}</li>
                            <li>
                                <p><i>"{{$description}}" <?php echo strlen($profile->self_description) > 80 ? "More..." : "" ?> </i></p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <table class="table_working_hours">
                            <tbody>
                                <tr class="opened_1">
                                    <td class="day_label1">Age / Height:</td>
                                    <td class="day_value">{{$profile->age()}} Yrs, {{$heights[0]}}ft {{$heights[1]}}in</td>
                                </tr>
                                <tr class="opened">
                                    <td class="day_label1">Sub Caste:</td>
                                    <td class="day_value">{{$profile->subcast}}</td>
                                </tr>
                                <tr class="opened">
                                    <td class="day_label1">Marital Status:</td>
                                    <td class="day_value">{{$profile->marital_status}}</td>
                                </tr>
                                <tr class="opened">
                                    <td class="day_label1">Location:</td>
                                    <td class="day_value">{{$profile->present_country}} - {{$profile->present_state}}</td>
                                </tr>
                                <tr class="closed">
                                    <td class="day_label1">Profile Created by:</td>
                                    <td class="day_value closed"><span>{{$profile->profile_created_by}}</span></td>
                                </tr>
                                <tr class="closed">
                                    <td class="day_label1">Education:</td>
                                    <td class="day_value closed"><span>{{$profile->education}}</span></td>
                                </tr>
                                <tr class="opened">
                                    <td class="day_label1">Designation:</td>
                                    <td class="day_value">{{$profile->designation}}</td>
                                </tr>
                                <?php
                                if (sizeof($mutualReferences) != 0) {
                                    ?>
                                    <tr class="opened">
                                        <td class="day_label1">Mutual References:</td>
                                        <td class="day_value">{{implode(',', array_values($mutualReferences))}}</td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                        <div class="buttons">
                            <!-- <div class="vertical">Send Mail</div> -->
                            <div class="vertical">
                                <a href="{{action('ProfilesController@show',$profile->id)}}" class="vertical">View Full Profile</a>
                                <?php
                                $requestSentController = new App\Http\Controllers\RequestSentController();
                                if ($requestSentController->isRequestSentTo($profile->id)) {
                                    ?>
                                    <a href="/requests" class="vertical">View Request Sent</a>
                                <?php } else if ($requestSentController->isRequestReceivedFrom($profile->id)) {
                                ?>
                                    <a href="/requests" class="vertical">View Request Received</a>
                                <?php
                                } else {
                                    ?>
                                    <a href="#" onclick="sendInterestClicked()" class="vertical">Send Interest</a>
                                <?php
                                }
                                ?>
                                <?php
                                $marriedController = new App\Http\Controllers\MarriedController();
                                // Checking if logged in user is not married and searched user is also not married. 
                                // If any one of them is married, Send request button will not be displayed.
                                if (!($marriedController->isMarried(Auth::user()->Profile->id)) and !($marriedController->isMarried($profile->id))) {
                                    ?>
                                    <form id="sendInterestForm" method="post" action="{{url('requestsent')}}">
                                        @csrf
                                        <input type="hidden" name="profileid" value="{{$profile->id }}" />
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            @endforeach
            {{$filteredProfiles->appends(Request::all())->links()}}
        </div>

        <!-- Right Side Bar -->
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
                                            <img src="<?php if ($viewedProfile->profile_pic_path != null) { ?>/storage/profile_images/thumbnail/{{$profile_pics[0]}} <?php } ?>" class="img-responsive" alt="" />
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

<script type="text/javascript">
    function setAction() {
        var your_form = document.getElementById('profile_search_form');
        your_form.action = "/profile/" + document.getElementsByName("profileid")[0].value;
    }

    function sendInterestClicked() {
        document.getElementById("sendInterestForm").submit();
    }
</script>
@endsection