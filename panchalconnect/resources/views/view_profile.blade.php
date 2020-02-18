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
                    // echo "Your Profile";
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
            <div class="col_4">

                <div class="basic_1">
                    <div class="col-md-12 basic_1_left">
                        <div class="basic_3">

                            <table width=100%>
                                <td>
                                    <h4>{{ $profile->User->name }} {{ $profile->User->lastname }}</h4>
                                </td>
                                <?php
                                if ($isSelf || Auth::user()->isAdmin()) {
                                    ?>
                                    <td align="right">
                                        <h3><a href="{{action('ProfilesController@edit',$profile->id)}}">Edit Profile</a></h3>
                                    </td>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                        <hr>
                        <h3 class="profile_title">Appearance</h3>
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
                                                                        <img id="image{{$i}}" src="/storage/profile_images/{{$profile_pic_path}}" onclick="showInMainImage('image{{$i}}')" />&nbsp;
                                                                    </li>
                                                                <?php
                                                                        $i++;
                                                                    }
                                                                }
                                                                for ($i = $totalPics + 1; $i <= 4; $i++) {
                                                                    ?>
                                                                <li data-thumb="#">
                                                                    <img id="image{{$i}}" src="#" onclick="showInMainImage('image{{$i}}')" />&nbsp;
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
                                            <td class="day_label">
                                                <h3>Profile No:</h3>
                                            </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <h3><b>{{$profile->id}}</b></h3>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label"><b>Status:</b></td>
                                            <td class="day_value">
                                                <b>{{$profile->status}}</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <hr>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Gender :</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio" name="gender" value="M" <?php if ($profile->gender == 'M') {
                                                                                                    echo "checked";
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>> Male &nbsp;&nbsp;
                                                    <input type="radio" name="gender" value="F" <?php if ($profile->gender == 'F') {
                                                                                                    echo "checked";
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>> Female
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Physical Status:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="physical_status" name="physical_status">
                                                        <option value="Normal">Normal</option>
                                                        <option value="Abnormal">Abnormal</option>
                                                        <option value="Handicapped">Handicapped</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Complexion:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="complexion" name="complexion">
                                                        <option value="Very Fair">Very Fair</option>
                                                        <option value="Fair">Fair</option>
                                                        <option value="Dark">Dark</option>
                                                    </select>
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
                                                        <input oninput="this.className = ''" type="text" name="heightfeet" id="heightfeet" value="<?php echo ($profile->height != null) ? $heights[0] : "" ?>" onblur="validateNumber('heightfeet')"> feet
                                                    </div>
                                                    <div class="oneline">
                                                        <input oninput="this.className = ''" type="text" name="heightinches" id="heightinches" value="<?php echo ($profile->height != null) ? $heights[1] : "" ?>" onblur="validateNumber('heightinches')"> inches
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Weight:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="weight" id="weight" value="{{$profile->weight}}" oninput="this.className = ''" onblur="validateNumber('weight')">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Specs:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio" name="specs" value="Yes" <?php if ($profile->specs == 'Yes') {
                                                                                                        echo "checked";
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio" name="specs" value="No" <?php if ($profile->specs == 'No') {
                                                                                                    echo "checked";
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>> No &nbsp;&nbsp;
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
                                        <h3 class="profile_title">Describe Yourself</h3>
                                        <tr class="opened_1">
                                            <td class="day_value">
                                                <div class="container2">
                                                    <div class="comment">
                                                        <textarea class="textinput" cols="130" rows="5" oninput="this.className = ''" name="self_description">{{$profile->self_description}}</textarea>
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
                            <div class="col-sm-6">
                                <h3 class="profile_title">Basic Details</h3>
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Profile Created By:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="profile_created_by" name="profile_created_by" onchange="ShowHideDivProfileCreatedBy()">
                                                        <option value="Self">Self</option>
                                                        <option value="Sibling">Sibling</option>
                                                        <option value="Parent/Guardian">Parent/Guardian</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                                <div id="divProfileCreatedBy" class="inputText_block1" style="display: none">
                                                    <input class="optional valid" type="text" name="profile_created_by_others" id="profile_created_by_others" value="{{$profile->profile_created_by}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Marital Status:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="marital_status" name="marital_status">
                                                        <option value="Never Married">Never Married</option>
                                                        <option value="Divorced">Divorced</option>
                                                        <option value="Widowed">Widowed</option>
                                                        <option value="Annulled">Annulled</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Hobby:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="hobby" name="hobby" onchange="showHideDivHobby()">
                                                        <option>Music</option>
                                                        <option>Cooking</option>
                                                        <option>Sports</option>
                                                        <option>Programming</option>
                                                        <option>Dancing</option>
                                                        <option>Reading</option>
                                                        <option>Writing</option>
                                                        <?php
                                                        $seededHobbies = array("Music", "Cooking", "Sports", "Programming", "Dancing", "Reading", "Writing");
                                                        foreach ($allHobbies as $allHobby) {
                                                            if (in_array($allHobby->hobby, $seededHobbies) == false) {
                                                                ?>
                                                                <option>{{$allHobby->hobby}}</option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        <option>Others</option>
                                                    </select>
                                                </div>
                                                <div id="divHobby" class="inputText_block1" style="display: none">
                                                    <input class="optional valid" type="text" name="hobby_others" id="hobby_others" value="{{$profile->hobby}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Subcast:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="subcast" value="{{$profile->subcast}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Native:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="native" value="{{$profile->native}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-1" style="border-left: 1px solid rgb(245, 239, 239); height: 200px;"></div>
                            <div class="col-sm-5">
                                <h3 class="profile_title">Life Style</h3>
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Drink:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio" name="drink" value="Yes" <?php if ($profile->drink == 'Yes') {
                                                                                                        echo "checked";
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio" name="drink" value="No" <?php if ($profile->drink == 'No') {
                                                                                                    echo "checked";
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>> No &nbsp;&nbsp;
                                                    <input type="radio" name="drink" value="Occasionally" <?php if ($profile->drink == 'Occasionally') {
                                                                                                                echo "checked";
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>> Occasionally
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Smoke:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio" name="smoke" value="Yes" <?php if ($profile->smoke == 'Yes') {
                                                                                                        echo "checked";
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio" name="smoke" value="No" <?php if ($profile->smoke == 'No') {
                                                                                                    echo "checked";
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>> No &nbsp;&nbsp;
                                                    <input type="radio" name="smoke" value="Occasionally" <?php if ($profile->smoke == 'Occasionally') {
                                                                                                                echo "checked";
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>> Occasionally
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Vegetarian:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio" name="vegetarian" value="Yes" <?php if ($profile->vegetarian == 'Yes') {
                                                                                                            echo "checked";
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio" name="vegetarian" value="No" <?php if ($profile->vegetarian == 'No') {
                                                                                                            echo "checked";
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>> No &nbsp;&nbsp;
                                                    <input type="radio" name="vegetarian" value="Occasionally" <?php if ($profile->vegetarian == 'Occasionally') {
                                                                                                                    echo "checked";
                                                                                                                } else {
                                                                                                                    echo "";
                                                                                                                } ?>> Occasionally
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Non-Vegetarian:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio" name="non_vegetarian" value="Yes" <?php if ($profile->non_vegetarian == 'Yes') {
                                                                                                                echo "checked";
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio" name="non_vegetarian" value="No" <?php if ($profile->non_vegetarian == 'No') {
                                                                                                                echo "checked";
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>> No &nbsp;&nbsp;
                                                    <input type="radio" name="non_vegetarian" value="Occasionally" <?php if ($profile->non_vegetarian == 'Occasionally') {
                                                                                                                        echo "checked";
                                                                                                                    } else {
                                                                                                                        echo "";
                                                                                                                    } ?>> Occasionally
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Eggetarian:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio" name="eggetarian" value="Yes" <?php if ($profile->eggetarian == 'Yes') {
                                                                                                            echo "checked";
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio" name="eggetarian" value="No" <?php if ($profile->eggetarian == 'No') {
                                                                                                            echo "checked";
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>> No &nbsp;&nbsp;
                                                    <input type="radio" name="eggetarian" value="Occasionally" <?php if ($profile->eggetarian == 'Occasionally') {
                                                                                                                    echo "checked";
                                                                                                                } else {
                                                                                                                    echo "";
                                                                                                                } ?>> Occasionally
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr />
                        <h3 class="profile_title">Astro Details</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Date:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="birth_date" id="datepicker-3" placeholder="Select Date..." value="{{$profile->birth_date}}" onchange="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Time:</td>
                                            <td class="day_value">
                                                <div class="select-block1timepicker">
                                                    <select id="hour" name="hour">
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                        <option value="5">05</option>
                                                        <option value="6">06</option>
                                                        <option value="7">07</option>
                                                        <option value="8">08</option>
                                                        <option value="9">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select> :
                                                    <select id="minute" name="minute">
                                                        <option value="0">00</option>
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                        <option value="5">05</option>
                                                        <option value="6">06</option>
                                                        <option value="7">07</option>
                                                        <option value="8">08</option>
                                                        <option value="9">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                        <option value="31">31</option>
                                                        <option value="32">32</option>
                                                        <option value="33">33</option>
                                                        <option value="34">34</option>
                                                        <option value="35">35</option>
                                                        <option value="36">36</option>
                                                        <option value="37">37</option>
                                                        <option value="38">38</option>
                                                        <option value="39">39</option>
                                                        <option value="40">40</option>
                                                        <option value="41">41</option>
                                                        <option value="42">42</option>
                                                        <option value="43">43</option>
                                                        <option value="44">44</option>
                                                        <option value="45">45</option>
                                                        <option value="46">46</option>
                                                        <option value="47">47</option>
                                                        <option value="48">48</option>
                                                        <option value="49">49</option>
                                                        <option value="50">50</option>
                                                        <option value="51">51</option>
                                                        <option value="52">52</option>
                                                        <option value="53">53</option>
                                                        <option value="54">54</option>
                                                        <option value="55">55</option>
                                                        <option value="56">56</option>
                                                        <option value="57">57</option>
                                                        <option value="58">58</option>
                                                        <option value="59">59</option>
                                                    </select> :
                                                    <select id="second" name="second">
                                                        <option value="0">00</option>
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                        <option value="5">05</option>
                                                        <option value="6">06</option>
                                                        <option value="7">07</option>
                                                        <option value="8">08</option>
                                                        <option value="9">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                        <option value="31">31</option>
                                                        <option value="32">32</option>
                                                        <option value="33">33</option>
                                                        <option value="34">34</option>
                                                        <option value="35">35</option>
                                                        <option value="36">36</option>
                                                        <option value="37">37</option>
                                                        <option value="38">38</option>
                                                        <option value="39">39</option>
                                                        <option value="40">40</option>
                                                        <option value="41">41</option>
                                                        <option value="42">42</option>
                                                        <option value="43">43</option>
                                                        <option value="44">44</option>
                                                        <option value="45">45</option>
                                                        <option value="46">46</option>
                                                        <option value="47">47</option>
                                                        <option value="48">48</option>
                                                        <option value="49">49</option>
                                                        <option value="50">50</option>
                                                        <option value="51">51</option>
                                                        <option value="52">52</option>
                                                        <option value="53">53</option>
                                                        <option value="54">54</option>
                                                        <option value="55">55</option>
                                                        <option value="56">56</option>
                                                        <option value="57">57</option>
                                                        <option value="58">58</option>
                                                        <option value="59">59</option>
                                                    </select>
                                                    <select id="format" name="format">
                                                        <option value="AM">AM</option>
                                                        <option value="PM">PM</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Place:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="birth_place" value="{{$profile->birth_place}}" oninput="this.className = ''">
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
                                            <td class="day_label">Rashi:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="rashi" name="rashi" placeholder="Select Rashi...">
                                                        <option value="Maish">Aries or Maish</option>
                                                        <option value="Vrish">Taurus or Vrish</option>
                                                        <option value="Mithun">Gemini or Mithun</option>
                                                        <option value="Kark">Cancer or Kark</option>
                                                        <option value="Singh">Leo or Singh</option>
                                                        <option value="Tula">Libra or Tula</option>
                                                        <option value="Vrishchik">Scorpio or Vrishchik</option>
                                                        <option value="Makar">Capricorn or Makar</option>
                                                        <option value="Kumbh">Aquarius or Kumbh</option>
                                                        <option value="Meen">Pisces or Meen</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mangal:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio" name="mangal" value="1" <?php if ($profile->mangal == '1') {
                                                                                                    echo "checked";
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio" name="mangal" value="0" <?php if ($profile->mangal == '0') {
                                                                                                    echo "checked";
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>> No
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Shani:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio" name="shani" value="1" <?php if ($profile->shani == '1') {
                                                                                                    echo "checked";
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio" name="shani" value="0" <?php if ($profile->shani == '0') {
                                                                                                    echo "checked";
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>> No
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <!-- <div class="basic_3">
                                <h4>Education & Career</h4>
                            </div>
                            <hr> -->
                        <div class="row">
                            <div class="col-sm-5">
                                <h3 class="profile_title">Education</h3>
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Education :</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="education" id="education" onchange="ShowHideDivEducation()">
                                                        <option>Below SSC</option>
                                                        <option>SSC</option>
                                                        <option>HSC</option>
                                                        <option>BCA</option>
                                                        <option>BBA</option>
                                                        <option>MCA</option>
                                                        <option>MBA</option>
                                                        <option>BSC</option>
                                                        <option>Diploma Computer Engineering</option>
                                                        <option>Diploma Electrical Engineering</option>
                                                        <option>BE-Electrical Engineering</option>
                                                        <option>BE-Computer Engineering</option>
                                                        <option>Ph.D</option>
                                                        <option>Others</option>
                                                    </select>
                                                </div>
                                                <div id="divEducation" class="inputText_block1" style="display:none" ?>
                                                    <input class="optional valid" type="text" name="education_others" id="education_others" value="{{$profile->education}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-2" style="border-left: 1px solid rgb(245, 239, 239); height: 200px;"></div>
                            <div class="col-sm-5">
                                <h3 class="profile_title">Career</h3>
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Occupation :</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="occupation" id="occupation" onchange="showHideDevOccupation()">
                                                        <option value="Job">Job</option>
                                                        <option value="Business">Business</option>
                                                        <option value="Home Maker">Home Maker</option>
                                                        <option value="Not Applicable">Not Applicable</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">
                                                <div id="divAreaOfBusinessLabel" style="display: <?php echo ($profile->occupation == 'Job') ? "none" : "block" ?>">
                                                    Area of Bussiness :
                                                </div>
                                            </td>
                                            <td class="day_value">
                                                <div class="inputText_block1" id="divAreaOfBusiness" style="display: <?php echo ($profile->occupation == 'Job') ? "none" : "block" ?>">
                                                    <input class="optional valid" type="text" name="area_of_business" id="area_of_business" value="{{$profile->area_of_business}}" id="area_of_business" oninput="this.className = ''">
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
                                                    <input class="optional valid" type="text" name="designation" id="designation" value="{{$profile->designation}}" id="designation" oninput="this.className = ''">
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
                                                <div class="inputText_block1" style="display: <?php echo ($profile->occupation == 'Job') ? "block" : "none" ?>">
                                                    <div id="divCompanyName" style="display: <?php echo ($profile->occupation == "Job" || $profile->occupation == "Business") ? "block" : "none" ?>">
                                                        <input type="text" name="company_name" value="{{$profile->company_name}}" oninput="this.className = ''">
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
                                                        <input type="text" name="annual_income" id="annual_income" value="{{$profile->annual_income}}" oninput="this.className = ''" onblur="validateNumber('annual_income')">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>

                        <!-- <div class="basic_3">
                                <h4>Communication Details</h4>
                            </div>
                            <hr> -->
                        <h3 class="profile_title">Contact Details</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <br>
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">
                                                <h3>Email Address: </h3>
                                            </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <h3><b>{{Auth::user()->email}}</b></h3>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <br>
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Contact Number :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="contact_no" id="contact_no" value="{{$profile->contact_no}}" oninput="this.className = ''" onblur="validateContactNumber('contact_no')">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <h3 class="profile_title">Present Address</h3>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Address :</td>
                                            <td class="day_value">
                                                <div class="container3">
                                                    <div class="comment3">
                                                        <textarea class="textinput3" oninput="this.className = 'textinput3'" name="present_address" id="present_address">{{$profile->present_address}}</textarea>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">City: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="present_city" id="present_city" value="{{$profile->present_city}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Taluka: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="present_taluka" id="present_taluka" value="{{$profile->present_taluka}}" oninput="this.className = ''">
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
                                                    <input type="text" name="present_district" id="present_district" value="{{$profile->present_district}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">State: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="present_state" id="present_state" value="{{$profile->present_state}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Country: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="present_country" id="present_country" value="{{$profile->present_country}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Pincode: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="present_pincode" id="present_pincode" value="{{$profile->present_pincode}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <h3 class="profile_title">Permanent Address</h3>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <input type="checkbox" name="sameAddress" class="radio_1" id="sameAddress" onclick="sameAddressAction()" /> <b><i> Same as Present Address</i></b> &nbsp;&nbsp;
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Address :</td>
                                            <td class="day_value">
                                                <div class="container3">
                                                    <div class="comment3">
                                                        <textarea class="textinput3" name="permanent_address" id="permanent_address" oninput="this.className = 'textinput3'">{{$profile->permanent_address}}</textarea>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">City: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="permanent_city" id="permanent_city" value="{{$profile->permanent_city}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Taluka: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="permanent_taluka" id="permanent_taluka" value="{{$profile->permanent_taluka}}" oninput="this.className = ''">
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
                                                    <input type="text" name="permanent_district" id="permanent_district" value="{{$profile->permanent_district}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">State: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="permanent_state" id="permanent_state" value="{{$profile->permanent_state}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Country: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="permanent_country" id="permanent_country" value="{{$profile->permanent_country}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Pincode: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="permanent_pincode" id="permanent_pincode" value="{{$profile->permanent_pincode}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>

                        <!-- <div class="basic_3">
                                <h4>Family Details</h4>
                            </div>
                            <hr> -->
                        <div class="row">
                            <div class="col-sm-5">
                                <table class="table_working_hours">
                                    <tbody>
                                        <h3> Father's Details </h3>
                                        <tr class="opened_1">
                                            <td class="day_label">Father's Name :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="father_name" value="{{$profile->father_name}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Father's Ocuupation :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="father_occupation" value="{{$profile->father_occupation}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Father's Annual Income :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="father_annual_income" id="father_annual_income" value="{{$profile->father_annual_income}}" oninput="this.className = ''" onblur="validateNumber('father_annual_income')">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Father's Contact Number :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="father_contact_no" id="father_contact_no" value="{{$profile->father_contact_no}}" oninput="this.className = ''" onblur="validateContactNumber('father_contact_no')">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-1" style="border-left: 1px solid rgb(245, 239, 239); height: 200px;"></div>
                            <div class="col-sm-5">
                                <table class="table_working_hours">
                                    <tbody>
                                        <h3> Mother' Details </h3>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Name :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="mother_name" value="{{$profile->mother_name}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Ocuupation :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="mother_occupation" value="{{$profile->mother_occupation}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Annual Income :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="mother_annual_income" id="mother_annual_income" value="{{$profile->mother_annual_income}}" oninput="this.className = ''" onblur="validateNumber('mother_annual_income')">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Contact Number :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="mother_contact_no" id="mother_contact_no" value="{{$profile->mother_contact_no}}" oninput="this.className = ''" onblur="validateContactNumber('mother_contact_no')">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table_working_hours">
                                    <tbody>
                                        <h3> Brothers & Sister's Details </h3>
                                        <tr class="opened_1">
                                            <td class="day_label">Number Of Brothers :</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="no_of_brothers" name="no_of_brothers">
                                                        <option value="None">None</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="More than 5">More than 5</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Number Of Sisters :</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="no_of_sisters" name="no_of_sisters">
                                                        <option value="None">None</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="More than 5">More than 5</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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

    function showInMainImage(image) {
        alert(image + " clicked");
    }
</script>
@endsection