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
            
            <div class="col_4">

                <div class="basic_1">
                    <div class="col-md-12 basic_1_left">
                        @if($isSelf  && $profile->status != "MARRIED" && $profile->status != "ACTIVE")
                        <div class="alert alert-warning">
                            <ul>
                                <li>
                                    <b><i class='fa fa-warning' aria-hidden='true'></i> Your profile is INACTIVE. Please <a href="/activate" class="vertical">activate</a> so other can search you and send interest to you.</b> 
		    	            	</li>
                            </ul>
                        </div>
                        @endif

                        @if($isSelf  && ($profile->profile_pic_path == null || $profile->profile_pic_path == ""))
                        <div class="alert alert-warning">
                            <ul>
                                <li>
                                    <b><i class='fa fa-warning' aria-hidden='true'></i> You do not have any profile pic. Please <a href="{{action('ProfilesController@manageProfilePic',$profile->id)}}">upload</a> ateast one.</b> 
		    	            	</li>
                            </ul>
                        </div>
                        @endif

                        @if($failuremsg != "")
                        <div class="alert alert-danger">
                            <ul>
                                <li>{{$failuremsg}}</li>
                            </ul>
                        </div>
                        @endif

                        @if($failuremsg == "")

                        @if($successmsg != "")
		                <div class="alert alert-success">
		                	<p><i class='fa fa-check' aria-hidden='true'></i> {{$successmsg}}</p>
		                </div>
		                @endif

                        <?php

                        $requestSentController = new App\Http\Controllers\RequestSentController();
                        ?>
                       
                        <div class="basic_3">
                            <table width=100%>
                                <td>
                                    <h4>{{$profile->id}} | {{ $profile->User->name }} {{ $profile->User->lastname }}</h4>
                                    <ul class="login_details1">
                                        <?php
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
                                        ?>
                                        <li>last seen {{$lastSeen}} ({{date("d-M-Y", strtotime($profile->user->last_login_date))}})</li>
                                    </ul>
                                </td>
                                
                                    <td align="right">
                                    <div class="buttons">
                                        <!-- <div class="vertical">Send Mail</div> -->
                                        <div class="vertical">
                                            <?php
                                            $marriedController = new App\Http\Controllers\MarriedController();
                                            ?>
                                           
                                            <?php
                                                if (($isSelf  && $profile->status != "MARRIED") || (Auth()->user() != null && Auth()->user()->isAdmin())) {
                                            ?>
                                                    <a href="{{action('ProfilesController@manageProfilePic',$profile->id)}}" class="vertical">Add / Change Photo</a>
                                                    <a href="{{action('ProfilesController@edit',$profile->id)}}" class="vertical">Edit Profile</a>
                                            <?php
                                                }
                                            ?>
                                            
                                            <?php
                                            if ($isGuest || ($isGuest && $profile->status != "MARRIED")) {
                                            ?> <a href="/login" class="vertical">Login/Register</a>
                                            <?php
                                            } else if ($noProfile && $profile->status != "MARRIED") {
                                            ?>
                                                Create your profile to send request <a href="{{route('profile.create')}}" class="vertical">Create</a>
                                                <?php
                                            } else if ($isSelf && $profile->status != "MARRIED") {
                                                $paymentController = new App\Http\Controllers\PaymentController();
                                            ?>
                                                @if(!$profile->isActive())
                                                    @if($profile->status == "RENEW")
                                                        <a href="/activate" class="vertical">Renew Profile</a>
                                                    @else
                                                        <a href="/activate" class="vertical">Activate Profile</a>
                                                    @endif
                                                @endif
                                                @if($profile->isActive() && PROMOTE_ENABLED == true && $paymentController->getPaymentDetailsForPromoteProfileFor($profile->id) == null)
                                                    @if (PROMOTE_PAYMENT_ENABLED == true)
                                                        <a href="/featuredprofile" class="vertical">Promote Profile</a>
                                                    @endif
                                                @endif
                                            <?php
                                            } else if($noProfile == false && Auth()->user()->Profile->isActive() == false && Auth()->user()->Profile->status != "MARRIED" && $profile->status != "MARRIED") {
                                                echo "Want to send request? <a href='/activate' class='vertical'>Activate your Profile</a>";
                                            } else if ($isSent && $profile->status != "MARRIED" && Auth()->user()->Profile->status != "MARRIED") {
                                            ?>
                                                <a href="/requests" class="vertical">View Request Sent</a>
                                            <?php
                                            } else if ($isReceived && $profile->status != "MARRIED" && Auth()->user()->Profile->status != "MARRIED") {
                                            ?>
                                                <a href="/requests" class="vertical">View Request Received</a>
                                            <?php
                                            } else {
                                                // Checking if logged in user is not married and searched user is also not married. 
                                                // If any one of them is married, Send request button will not be displayed.
                                                if ($noProfile == false && (!($marriedController->isMarried(Auth()->user()->Profile->id)) and !($marriedController->isMarried($profile->id)))) {
                                                    $canSendAgain = $requestSentController->canRequestSentAgainTo($profile->id);
                                                    if ($canSendAgain) {
                                                ?>
                                                    <a href="#" onclick="sendInterestClicked()" class="vertical">Send Interest</a>
                                                    <form id="sendInterestForm" method="post" action="{{url('requestsent')}}">
                                                        @csrf
                                                        <input type="hidden" name="profileid" value="{{$profile->id }}" />
                                                        <!-- <input type="submit" value="Send Request" /> -->
                                                    </form>
                                                
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
                                                }
                                            }
                                            ?>
                                            <br>
                                            @if($isGuest == false && Auth()->user()->isAdmin() == false)
                                            @if($isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestSentApproved($profile->id) || $requestSentController->isRequestReceivedApproved($profile->id)) && ($profile->status != "MARRIED" && Auth()->user()->Profile->status != "MARRIED"))
                                                <ul class="login_details1">
                                                    <li>
                                                        <label style="color: green; margin: 10px">
                                                            <i class='fa fa-check' aria-hidden='true'></i> Request Accepted
                                                        </label>
                                                    </li>
                                                </ul>
                                             @elseif($isSelf && $profile->status == "MARRIED")
                                                <ul class="login_details1">
                                                    <li>
                                                        <label style="color: #c32143; margin: 10px">
                                                            You are married with {{$marriedController->marriedPartnerOf($profile->id)}}
                                                        </label>
                                                    </li>
                                                </ul>
                                            @elseif($isSelf ==false && $profile->status == "MARRIED")
                                                <ul class="login_details1">
                                                    <li>
                                                        <label style="color: #c32143; margin: 10px">
                                                            @if($profile->gender == "M") He @else She @endif is married with {{$marriedController->marriedPartnerOf($profile->id)}}
                                                        </label>
                                                    </li>
                                                </ul>
                                            @elseif($isGuest == false && $noProfile == false && $marriedController->isMarried(Auth()->user()->Profile->id))
                                                <ul class="login_details1">
                                                    <li>
                                                        <label style="color: #c32143; margin: 10px">
                                                            You cannot send request as you are already married.
                                                        </label>
                                                    </li>
                                                </ul>
                                            @elseif($isGuest == false && $noProfile == false && ($isSent || $isReceived))
                                                <ul class="login_details1">
                                                    <li>
                                                        <label style="color: #c32143; margin: 10px">
                                                            <i class='fa fa-exclamation' aria-hidden='true'></i> Request Pending
                                                        </label>
                                                    </li>
                                                </ul>
                                            @endif
                                            @endif
                                        </div>
                                    </div>
                                    </td>
                                
                            </table>
                        </div>
                        <hr>
                        <!-- The Modal -->
                        <div id="myModal" class="modal">
                          <span class="close">&times;</span>
                          <img class="modal-content" id="img01">
                          <div id="caption"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_value" colspan="2">
                                                <div class="img" id="profileImageDiv">
                                                    <div class="profile flexslider">
                                                        <ul class="slides">
                                                            
                                                                                                    
                                                            <?php
                                                            $totalPics = 0;
                                                            if ($profile->profile_pic_path != null) {
                                                                $profile_pic_paths = explode(",", $profile->profile_pic_path);
                                                                $totalPics = sizeof($profile_pic_paths);
                                                                $i = 1;

                                                                foreach ($profile_pic_paths as $profile_pic_path) {
                                                            ?>
                                                                    <li data-thumb="/storage/profile_images/thumbnail/{{$profile_pic_path}}">
                                                                        <img class="myImg" id="image{{$i}}" src="/storage/profile_images/mainimage/{{$profile_pic_path}}" onclick="showInMainImage('image{{$i}}')" />&nbsp;
                                                                    </li>
                                                                <?php
                                                                    $i++;
                                                                }
                                                            }
                                                            for ($i = $totalPics + 1; $i <= 4; $i++) {
                                                                ?>
                                                                <li data-thumb="/images/blank-profile-picture.png">
                                                                    <img class="myImg" id="image{{$i}}" src="/images/blank-profile-picture.png" onclick="showInMainImage('image{{$i}}')" />&nbsp;
                                                                </li>
                                                            <?php
                                                            }

                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-7">
                                <table class="table_working_hours">
                                    <tbody>
                                        <br>
                                        
                                        <tr class="opened_1">
                                            <td class="day_label">Profile Id:</td>
                                            <td class="day_value">
                                                <b>{{$profile->id}}</b>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Status:</td>
                                            <td class="day_value">
                                                <b>
                                                    <?php
                                                    if ($profile->status == "RENEW") {
                                                        echo "INACTIVE (Please Renew)";
                                                    } else {
                                                        echo $profile->status;
                                                    }
                                                    ?>
                                                </b>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Profile Created By:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <b>{{$profile->profile_created_by}}</b>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <hr>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Gender:</td>
                                            <td class="day_value">
                                                <?php if ($profile->gender == 'M') {
                                                    echo "Male";
                                                } else {
                                                    echo "Female";
                                                } ?>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Physical Status:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    {{$profile->physical_status}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Complexion:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    {{$profile->complexion}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Age:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->age()}} Years
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Height:</td>
                                            <td class="day_value">
                                                <?php
                                                if ($profile->height != null) {
                                                    $heights = explode(".", $profile->height);
                                                }
                                                ?>
                                                <div class="inputText_block1">
                                                    <div class="oneline">
                                                        {{($profile->height != null && sizeof($heights) >= 1) ? $heights[0] : "0"}} Feet

                                                        {{($profile->height != null && sizeof($heights) == 2) ? $heights[1] : "0" }} Inches
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Weight:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->weight}} Kgs
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Specs:</td>
                                            <td class="day_value">
                                                {{$profile->specs}}
                                            </td>
                                        </tr>
                                       
                                        <tr class="opened_1">
                                            <td class="day_label">Marital Status:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    {{$profile->marital_status}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Hobby:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    {{$profile->hobby}}
                                                </div>
                                                <div id="divHobby" class="inputText_block1" style="display: none">
                                                    <input class="optional valid" type="text" name="hobby_others" id="hobby_others" value="{{$profile->hobby}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Subcaste:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->subcast}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Native:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->native}}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table_working_hours">
                                    <tbody>
                                        <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>About Me</b></div></h3>
                                        <tr class="opened_1">
                                            <td class="day_value">
                                                <div class="container2">
                                                    <div class="comment">
                                                        <p><i>"{{$profile->self_description}}"</i></p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Life Style</b></div></h3>
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Drink:</td>
                                            <td class="day_value">
                                                {{$profile->drink}}
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Smoke:</td>
                                            <td class="day_value">
                                                {{$profile->smoke}}
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Vegetarian:</td>
                                            <td class="day_value">
                                                {{$profile->vegetarian}}
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Non-Vegetarian:</td>
                                            <td class="day_value">
                                                {{$profile->non_vegetarian}}
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Eggetarian:</td>
                                            <td class="day_value">
                                                {{$profile->eggetarian}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-sm-2"></div>
                            <!-- <div class="col-sm-1" style="border-left: 1px solid rgb(245, 239, 239); height: 150px;"></div> -->
                            <div class="col-sm-6">
                                <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Education & Career</b></div></h3>
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Education :</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    {{$profile->education}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Occupation :</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    {{$profile->occupation}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">
                                                <div id="divAreaOfBusinessLabel" style="display: <?php echo ($profile->occupation == 'Business') ? "block" : "none" ?>">
                                                    Area of Bussiness :
                                                </div>
                                            </td>
                                            <td class="day_value">
                                                <div class="inputText_block1" id="divAreaOfBusiness" style="display: <?php echo ($profile->occupation == 'Business') ? "block" : "none" ?>">
                                                    {{$profile->area_of_business}}
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="opened_1">
                                            <td class="day_label">
                                                <div id="divDesignationLabel" style="display: <?php echo ($profile->occupation == 'Job') ? "block" : "none" ?>">
                                                    Designation :
                                                </div>
                                            </td>
                                            <td class="day_value">
                                                <div class="inputText_block1" id="divDesignation" style="display: <?php echo ($profile->occupation == 'Job') ? "block" : "none" ?>">
                                                    {{$profile->designation}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">
                                                <div id="divCompanyNameLabel" style="display: <?php echo ($profile->occupation == "Job" || $profile->occupation == "Business") ? "block" : "none" ?>">
                                                    Company Name :
                                                </div>
                                            </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <div id="divCompanyName" style="display: <?php echo ($profile->occupation == "Job" || $profile->occupation == "Business") ? "block" : "none" ?>">
                                                        {{$profile->company_name}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">
                                                <div id="divAnnualIncomeLabel" style="display: <?php echo ($profile->occupation == "Job" || $profile->occupation == "Business") ? "block" : "none" ?>">
                                                    Annual Income :
                                                </div>
                                            </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <div id="divAnnualIncome" style="display: <?php echo ($profile->occupation == "Job" || $profile->occupation == "Business") ? "block" : "none" ?>">
                                                        {{$profile->annual_income}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr />
                        <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Astro Details</b></div></h3>
                        <div class="row">
                            <div class="col-sm-4">
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Date:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{date('d-M-Y',strtotime($profile->birth_date))}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Time:</td>
                                            <td class="day_value">
                                                <?php
                                                $time = $profile->birth_time;
                                                $timeArray = explode(':', $time);
                                                if (sizeof($timeArray) == 3) {
                                                    $hr = $timeArray[0];
                                                    $min = $timeArray[1];
                                                    $sec = $timeArray[2];
                                                    if ($hr < 12) {
                                                        if ($hr == 0) {
                                                            $hr = 12;
                                                        }
                                                        $ampm = "AM";
                                                    } else {
                                                        if ($hr != 12) {
                                                            $hr = $hr - 12;
                                                        }
                                                        $ampm = "PM";
                                                    }
                                                } else {
                                                    $hr = "12";
                                                    $min = "00";
                                                    $sec = "00";
                                                    $ampm = "AM";
                                                }
                                                echo $hr . ":" . $min . ":" . $sec . " " . $ampm;
                                                ?>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Place:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->birth_place}}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-2">

                            </div>
                            <div class="col-sm-4">
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Rashi:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    {{$profile->rashi}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mangal:</td>
                                            <td class="day_value">
                                                <?php if ($profile->mangal == '1') {
                                                    echo "Yes";
                                                } else {
                                                    echo "No";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Shani:</td>
                                            <td class="day_value">
                                                <?php if ($profile->shani == '1') {
                                                    echo "Yes";
                                                } else {
                                                    echo "No";
                                                } ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-2">

                            </div>
                        </div>
                        <hr>
                        <!-- <div class="basic_3">
                                <h4>Communication Details</h4>
                            </div>
                            <hr> -->
                        <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Contact Details</b></div></h3>
                        @if($isGuest == true)
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see contact details, send request to {{$profile->user->name}} and it must be accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            And to send request, you must have an account created and active profile.
                            </b>
                        </div>                 
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && $marriedController->isMarried(Auth()->user()->Profile->id))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                                You can not see this details as you are already married.
                            </b>
                        </div>
                       
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $profile->status == "MARRIED")
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                                Already Married.
                            </b>
                        </div>
                        @elseif((Auth()->user()->isAdmin() == false && ($isGuest || $noProfile)) || (Auth()->user()->isAdmin() == false && $isSelf == false && (Auth()->user() == null || Auth()->user()->Profile == null || Auth()->user()->Profile->isActive() == false)))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see contact details, send request to {{$profile->user->name}} and it must be accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            And to send request, you must have an account created and active profile.
                            </b>
                        </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestSentTo($profile->id) == false && $requestSentController->isRequestSentApproved($profile->id) == false 
                            && $requestSentController->isRequestReceivedFrom($profile->id) == false && $requestSentController->isRequestReceivedApproved($profile->id) == false))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see contact details, send request to {{$profile->user->name}} and it must be accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            </b>
                        </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestSentTo($profile->id) && $requestSentController->isRequestSentApproved($profile->id) == false))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see contact details, you have sent request to {{$profile->user->name}} but it is not yet accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            </b>
			            </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestReceivedFrom($profile->id) && $requestSentController->isRequestReceivedApproved($profile->id) == false))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see contact details, you have received request from {{$profile->user->name}} but you have not taken action yet<br>
                            </b>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-sm-6">
                                <br>
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">
                                                Email Address:
                                            </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->user->email}}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-4">
                                <br>
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Contact Number :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->contact_no}}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                        <hr>
                        <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Present Address</b></div></h3>
                        @if($isGuest == true)
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see present address, send request to {{$profile->user->name}} and it must be accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            And to send request, you must have an account created and active profile.
                            </b>
                        </div>                 
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && $marriedController->isMarried(Auth()->user()->Profile->id))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                                You can not see this details as you are already married.
                            </b>
                        </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $profile->status == "MARRIED")
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                                Already Married.
                            </b>
                        </div>
                        @elseif((Auth()->user()->isAdmin() == false && ($isGuest || $noProfile)) || (Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && (Auth()->user() == null || Auth()->user()->Profile == null || Auth()->user()->Profile->isActive() == false)))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see present address, send request to {{$profile->user->name}} and it must be accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            And to send request, you must have an account created and active profile.
                            </b>
                        </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestSentTo($profile->id) == false && $requestSentController->isRequestSentApproved($profile->id) == false 
                            && $requestSentController->isRequestReceivedFrom($profile->id) == false && $requestSentController->isRequestReceivedApproved($profile->id) == false))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see present address, send request to {{$profile->user->name}} and it must be accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            </b>
                        </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestSentTo($profile->id) && $requestSentController->isRequestSentApproved($profile->id) == false))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see present address, you have sent request to {{$profile->user->name}} but it is not yet accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            </b>
			            </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestReceivedFrom($profile->id) && $requestSentController->isRequestReceivedApproved($profile->id) == false))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see present address, you have received request from {{$profile->user->name}} but you have not taken action yet<br>
                            </b>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Address :</td>
                                            <td class="day_value">
                                                <div class="container3">
                                                    <div class="comment3">
                                                        {{$profile->present_address}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">City: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->present_city}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Taluka: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->present_taluka}}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">District: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->present_district}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">State: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->present_state}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Country: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->present_country}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Pincode: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->present_pincode}}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                        <hr>
                        <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Permanent Address</b></div></h3>
                        @if($isGuest == true)
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see permanent address, send request to {{$profile->user->name}} and it must be accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            And to send request, you must have an account created and active profile.
                            </b>
                        </div>                 
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && $marriedController->isMarried(Auth()->user()->Profile->id))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                                You can not see this details as you are already married.
                            </b>
                        </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $profile->status == "MARRIED")
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                                Already Married.
                            </b>
                        </div>
                        @elseif((Auth()->user()->isAdmin() == false && ($isGuest || $noProfile)) || (Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && (Auth()->user() == null || Auth()->user()->Profile == null || Auth()->user()->Profile->isActive() == false)))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see permanent address, send request to {{$profile->user->name}} and it must be accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            And to send request, you must have an account created and active profile.
                            </b>
                        </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestSentTo($profile->id) == false && $requestSentController->isRequestSentApproved($profile->id) == false 
                            && $requestSentController->isRequestReceivedFrom($profile->id) == false && $requestSentController->isRequestReceivedApproved($profile->id) == false))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see permanent address, send request to {{$profile->user->name}} and it must be accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            </b>
                        </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestSentTo($profile->id) && $requestSentController->isRequestSentApproved($profile->id) == false))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see permanent address, you have sent request to {{$profile->user->name}} but it is not yet accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            </b>
			            </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestReceivedFrom($profile->id) && $requestSentController->isRequestReceivedApproved($profile->id) == false))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see permanent address, you have received request from {{$profile->user->name}} but you have not taken action yet<br>
                            </b>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Address :</td>
                                            <td class="day_value">
                                                <div class="container3">
                                                    <div class="comment3">
                                                        {{$profile->permanent_address}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">City: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->permanent_city}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Taluka: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->permanent_taluka}}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">District: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->permanent_district}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">State: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->permanent_state}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Country: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->permanent_country}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Pincode: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->permanent_pincode}}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                        <hr>

                        <!-- <div class="basic_3">
                                <h4>Family Details</h4>
                            </div>
                            <hr> -->
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table_working_hours">
                                    <tbody>
                                        <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Father's Details</b></div></h3>
                                        <tr class="opened_1">
                                            <td class="day_label">Name :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->father_name}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Ocuupation :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->father_occupation}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Annual Income :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->father_annual_income}}
                                                </div>
                                            </td>
                                        </tr>
                                        @if($isGuest == true
                                        || (Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && $marriedController->isMarried(Auth()->user()->Profile->id))
                                        || (Auth()->user()->isAdmin() == false && $isSelf == false && $profile->status == "MARRIED")
                                        || ((Auth()->user()->isAdmin() == false && ($isGuest || $noProfile)) || (Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && (Auth()->user() == null || Auth()->user()->Profile == null || Auth()->user()->Profile->isActive() == false)))
                                        || (Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestSentTo($profile->id) == false && $requestSentController->isRequestSentApproved($profile->id) == false 
                                            && $requestSentController->isRequestReceivedFrom($profile->id) == false && $requestSentController->isRequestReceivedApproved($profile->id) == false))
                                        || (Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestSentTo($profile->id) && $requestSentController->isRequestSentApproved($profile->id) == false))
                                        || (Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestReceivedFrom($profile->id) && $requestSentController->isRequestReceivedApproved($profile->id) == false)))
                                        @else
                                        <tr class="opened_1">
                                            <td class="day_label">Contact Number :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->father_contact_no}}
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- <div class="col-sm-1" style="border-left: 1px solid rgb(245, 239, 239); height: 130px;"></div> -->
                            <div class="col-sm-6">
                                <table class="table_working_hours">
                                    <tbody>
                                        <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Mother' Details</b></div></h3>
                                        <tr class="opened_1">
                                            <td class="day_label">Name :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->mother_name}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Ocuupation :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->mother_occupation}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Annual Income :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->mother_annual_income}}
                                                </div>
                                            </td>
                                        </tr>
                                        @if($isGuest == true
                                        || (Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && $marriedController->isMarried(Auth()->user()->Profile->id))
                                        || (Auth()->user()->isAdmin() == false && $isSelf == false && $profile->status == "MARRIED")
                                        || ((Auth()->user()->isAdmin() == false && ($isGuest || $noProfile)) || (Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && (Auth()->user() == null || Auth()->user()->Profile == null || Auth()->user()->Profile->isActive() == false)))
                                        || (Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestSentTo($profile->id) == false && $requestSentController->isRequestSentApproved($profile->id) == false 
                                            && $requestSentController->isRequestReceivedFrom($profile->id) == false && $requestSentController->isRequestReceivedApproved($profile->id) == false))
                                        || (Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestSentTo($profile->id) && $requestSentController->isRequestSentApproved($profile->id) == false))
                                        || (Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestReceivedFrom($profile->id) && $requestSentController->isRequestReceivedApproved($profile->id) == false)))
                                        @else
                                        <tr class="opened_1">
                                            <td class="day_label">Contact Number :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    {{$profile->mother_contact_no}}
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($isGuest == true)
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see parent's contact, send request to {{$profile->user->name}} and it must be accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            And to send request, you must have an account created and active profile.
                            </b>
                        </div>                 
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && $marriedController->isMarried(Auth()->user()->Profile->id))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                                You can not see this details as you are already married.
                            </b>
                        </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $profile->status == "MARRIED")
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                                Already Married.
                            </b>
                        </div>
                        @elseif((Auth()->user()->isAdmin() == false && ($isGuest || $noProfile)) || (Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && (Auth()->user() == null || Auth()->user()->Profile == null || Auth()->user()->Profile->isActive() == false)))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see parent's contact, send request to {{$profile->user->name}} and it must be accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            And to send request, you must have an account created and active profile.
                            </b>
                        </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestSentTo($profile->id) == false && $requestSentController->isRequestSentApproved($profile->id) == false 
                            && $requestSentController->isRequestReceivedFrom($profile->id) == false && $requestSentController->isRequestReceivedApproved($profile->id) == false))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see parent's contact, send request to {{$profile->user->name}} and it must be accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            </b>
                        </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestSentTo($profile->id) && $requestSentController->isRequestSentApproved($profile->id) == false))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see parent's contact, you have sent request to {{$profile->user->name}} but it is not yet accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            </b>
			            </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestReceivedFrom($profile->id) && $requestSentController->isRequestReceivedApproved($profile->id) == false))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see parent's contact, you have received request from {{$profile->user->name}} but you have not taken action yet<br>
                            </b>
                        </div>
                        @endif
                        <hr>
                        <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Brothers & Sisters</b></div></h3>
                        <div class="row">
                            <div class="col-sm-4">
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Number Of Brothers :</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    {{$profile->no_of_brothers}}
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-2">

                            </div>
                            <div class="col-sm-4">
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Number Of Sisters :</td>
                                            <td class="day_value">
                                                {{$profile->no_of_sisters}}
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-2">

                            </div>
                        </div>
                        <hr>
                        <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>References</b></div></h3>
                        <?php
                        $references = App\Reference::where('profile_id',$profile->id)->get();
                        ?>
                        @if($isGuest == true)
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see references, send request to {{$profile->user->name}} and it must be accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            And to send request, you must have an account created and active profile.
                            </b>
                        </div>                 
                        @elseif (sizeof($references) == 0)
                            No references added
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && $marriedController->isMarried(Auth()->user()->Profile->id))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                                You can not see this details as you are already married.
                            </b>
                        </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $profile->status == "MARRIED")
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                                Already Married.
                            </b>
                        </div>
                        @elseif((Auth()->user()->isAdmin() == false && ($isGuest || $noProfile)) || (Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && (Auth()->user() == null || Auth()->user()->Profile == null || Auth()->user()->Profile->isActive() == false)))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see references, send request to {{$profile->user->name}} and it must be accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            And to send request, you must have an account created and active profile.
                            </b>
                        </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestSentTo($profile->id) == false && $requestSentController->isRequestSentApproved($profile->id) == false 
                            && $requestSentController->isRequestReceivedFrom($profile->id) == false && $requestSentController->isRequestReceivedApproved($profile->id) == false))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see references, send request to {{$profile->user->name}} and it must be accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            </b>
                        </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestSentTo($profile->id) && $requestSentController->isRequestSentApproved($profile->id) == false))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see references, you have sent request to {{$profile->user->name}} but it is not yet accepted by @if($profile->gender == "M") him. @else her. @endif<br>
                            </b>
			            </div>
                        @elseif(Auth()->user()->isAdmin() == false && $isSelf == false && $isGuest == false && $noProfile == false && ($requestSentController->isRequestReceivedFrom($profile->id) && $requestSentController->isRequestReceivedApproved($profile->id) == false))
                        <div class="alert alert-info">
                            <b>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> 
                            To see references, you have received request from {{$profile->user->name}} but you have not taken action yet<br>
                            </b>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table_working_hours">
                                    <tbody>
                                        <?php 
                                        $i = 2;
                                        foreach($references as $reference) {
                                        if ($i%2 == 0) {
                                            echo "<tr class='opened_1'>";
                                        }
                                            echo "<td class='day_value'>";
                                                echo $reference['first_name'] . " " . $reference['last_name'] . " (" . $reference['city'] . ")";
                                            echo "</td>";
                                        if($i%2 != 0) {
                                            echo "</tr>";
                                        }
                                        $i++; 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 match_right">
            <div class="profile_search1">
                <form method="post" id="profile_search_form" onsubmit="setAction()">
                    @CSRF
                    <input type="hidden" name="_method" value="GET" />
                    Search By Id: <input type="text" class="m_1" name="searchprofileid" size="30" placeholder="Enter Profile ID" required>
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

<script src="/js/multiform.js"></script>
<script type="text/javascript">
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
        });
    });

    function setAction() {
        var your_form = document.getElementById('profile_search_form');
        your_form.action = "/profile/" + document.getElementsByName("searchprofileid")[0].value;
    }

    function sendInterestClicked() {
        document.getElementById("sendInterestForm").submit();
    }

    function showInMainImage(image) {
        var img = document.getElementById(image);
        
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("img01");
        modal.style.display = "block";
        modalImg.src = img.src.replace("mainimage/", "");;
    }

    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() { 
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
</script>
@endsection