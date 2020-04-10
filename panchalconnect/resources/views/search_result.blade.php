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
            $profile_pic_paths[0] = "/images/blank-profile-picture.png";
            $profile_pic = "/images/blank-profile-picture.png";
            if ($profile->profile_pic_path != null) {
                $profile_pic_paths = explode(",", $profile->profile_pic_path);
                if ($profile_pic_paths != null || sizeof($profile_pic_paths) != 0) {
                    $profile_pic = "/storage/profile_images/mainimage/" . $profile_pic_paths[0];
                }
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
                $lastSeen = "today";
            } else if ($diff->format("%a") == 1) {
                $lastSeen = $diff->format("yesterday");
            } else {
                $lastSeen = $diff->format("%a days ago");
            }

            if (Auth()->user() != null && Auth()->user()->Profile != null) {
                $searchController = new App\Http\Controllers\SearchController();
                $mutualReferences = $searchController->getMutualReference($profile->id);
            }
            ?>
            <div class="profile_top">
                <h2>{{$profile->id}} | {{$profile->user->name}} {{$profile->user->lastname}}</h2>
                <div class="row">
                    <div class="col-sm-3 profile_left-top">
                        <img src="{{$profile_pic}}" class="img-responsive" alt="" width="400" height="400"/>

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
                                    <td class="day_value">{{$profile->age()}} Yrs, {{($profile->height != null) ? $heights[0] : "0"}} Ft {{($profile->height != null) ? $heights[1] : "0" }} In</td>
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
                                    <td class="day_label1">Occupation:</td>
                                    <td class="day_value">{{$profile->occupation}}</td>
                                </tr>
                                <?php
                                if ((Auth()->user() != null && Auth()->user()->Profile != null) && sizeof($mutualReferences) != 0) {
                                    ?>
                                    <tr class="opened">
                                        <td class="day_label1" style="color: #c32143"><b>Mutual References:</b></td>
                                        <td class="day_value" style="color: #c32143">{{implode(',', array_values($mutualReferences))}}</td>
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
                                $marriedController = new App\Http\Controllers\MarriedController();
                                if (Auth()->user() == null) {
                                    echo "<a class='vertical' href='/login'>Please Login/Register</a>";
                                } else if (Auth()->user()->Profile == null) {
                                    echo "<a class='vertical' href=" . route('profile.create') . ">Please create your profile</a>";
                                } else if (Auth()->user()->profile->isActive() == false  && Auth()->user()->Profile->status != "MARRIED" ) {
                                    echo "<a href='/activate' class='vertical'>Activate your Profile</a>";
                                } else {
                                    
                                $requestSentController = new App\Http\Controllers\RequestSentController();
                                if (($requestSentController->isRequestSentTo($profile->id) || $requestSentController->isRequestSentApproved($profile->id)) && ($marriedController->isMarried(Auth()->user()->Profile->id )== false)) {
                                    ?>
                                    <a href="/requests" class="vertical">View Request Sent</a>
                                <?php 
                                } else if ($requestSentController->isRequestReceivedFrom($profile->id) || $requestSentController->isRequestReceivedApproved($profile->id) && ($marriedController->isMarried(Auth()->user()->Profile->id )== false)) {
                                ?>
                                    <a href="/requests" class="vertical">View Request Received</a>
                                <?php
                                } else if (!($marriedController->isMarried(Auth()->user()->Profile->id)) and !($marriedController->isMarried($profile->id))) {
                                    $canSendAgain = $requestSentController->canRequestSentAgainTo($profile->id);
                                    if ($canSendAgain) {
                                    ?>
                                    <a href="#" onclick="sendInterestClicked({{$profile->id}})" class="vertical">Send Interest</a>
                                <?php
                                    } else {
                                    ?>
                                                <ul class="login_details1">
                                                <li>
                                                    <label style="color: #c32143; margin: 10px">
                                                        You cannot send request again.
                                                    </label>
                                                </li>
                                            </ul>
                                    <?php
                                            }
                                } else {
                                    ?>
                                    @if($profile->status == "MARRIED")
                                        <ul class="login_details1">
                                            <li>
                                                <label style="color: #c32143; margin: 10px">
                                                    @if($profile->gender == "M") He @else She @endif is married <?php echo ($marriedController->marriedPartnerOf($profile->id) != null) ? "with " . $marriedController->marriedPartnerOf($profile->id) : ""?>
                                                </label>
                                            </li>
                                        </ul>
                                    @elseif($marriedController->isMarried(Auth()->user()->Profile->id))
                                        <ul class="login_details1">
                                            <li>
                                                <label style="color: #c32143; margin: 10px">
                                                    You can not send request as you are already married.
                                                </label>
                                            </li>
                                        </ul>
                                    @endif
                                    <?php
                                }
                                ?>
                                <?php
                                
                                // Checking if logged in user is not married and searched user is also not married. 
                                // If any one of them is married, Send request button will not be displayed.
                                if (!($marriedController->isMarried(Auth()->user()->Profile->id)) and !($marriedController->isMarried($profile->id))) {
                                    ?>
                                    <form id="sendInterestForm" method="post" action="{{url('requestsent')}}">
                                        @csrf
                                        <input type="hidden" id="profileidInput" name="profileid" value="" />
                                    </form>
                                <?php } 
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
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
                    Search By Id: <input type="text" class="m_1" name="profilesearchid" size="30" placeholder="Enter Profile ID" required>
                    <input type="submit" value="Go">
                </form>
            </div>
            <section class="slider">

            </section>
            <div class="view_profile view_profile2">
                <h3>Recently Viewed Profiles</h3>
                <?php
                $user = Auth()->user();
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



    </div>
</div>

<script type="text/javascript">
    function setAction() {
        var your_form = document.getElementById('profile_search_form');
        your_form.action = "/profile/" + document.getElementsByName("profilesearchid")[0].value;
    }

    function sendInterestClicked($profileId) {
        document.getElementById("profileidInput").value = $profileId;
        document.getElementById("sendInterestForm").submit();
    }
</script>
@endsection