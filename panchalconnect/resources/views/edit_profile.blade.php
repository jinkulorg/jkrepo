@extends('layouts.app')

@section('content')
<form id="profileForm" action="{{action('ProfilesController@update',$id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" value="PATCH"/>
    <div class="grid_3">
        <div class="container">
            <div class="breadcrumb1">
                <ul>
                    <a href="/"><i class="fa fa-home home_1"></i></a>
                    <span class="divider">&nbsp;| &nbsp;</span>
                    <li class="current-page">
                        <h4>Edit Profile </h4>
                    </li>
                </ul>
            </div>

            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">

                <ul id="myTab" class="nav nav-tabs nav-tabs1" role="tablist">
                    <li class="nav-item"><a class="nav-link active_tab1" id="list_aboutmyself_details">About Myself</a></li>
                    <li class="nav-item"><a class="nav-link inactive_tab1" id="list_education_career_details">Education & Career</a></li>
                    <li class="nav-item"><a class="nav-link inactive_tab1" id="list_communication_details">Communication Details</a></li>
                    <li class="nav-item"><a class="nav-link inactive_tab1" id="list_family_details">Family Details</a></li>
                    <!-- <li class="nav-item"><a class="nav-link inactive_tab1" id="list_review_submit_details">Review & Submit</a></li> -->
                </ul>

                <!-- One "tab" for each step in the form: -->
                <div class="basic_1">
                    <div class="col-md-12 basic_1_left">
                        <!--------------------About Myself & Life Cycle------------------------------->
                        <div class="tab">
                            <div class="col-sm-6">
                                <h3>About Myself</h3>
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Select Profile Photo :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input class="optional <?php echo ($profile->profile_pic_path == null) ? "invalid" : "valid"?>" type="file" name="profile_pic_path[]" id="profile_pic" oninput="this.className = ''" onchange="showImages()" multiple>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_value" colspan=2>
                                                <div class="img" id="profileImageDiv">

                                                </div>
                                                <div id="divOldProfiles" style="display: block">
                                                    <?php
                                                    if ($profile->profile_pic_path != null) {
								                        $profile_pic_paths = explode(",",$profile->profile_pic_path);
								                        foreach($profile_pic_paths as $profile_pic_path) {
								                        	?>
								                        	<img width=100 height=100 src="/storage/profile_images/thumbnail/{{$profile_pic_path}}"/>
								                        	<?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>
                                       
                                        <tr class="opened_1">
                                            <td class="day_label">First Name :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="name" value = "{{$profile->user->name}}" disabled>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Last Name :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="lastname" value = "{{$profile->user->lastname}}" disabled>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Gender :</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio"  name="gender" value="M" <?php if ($profile->gender == 'M') { echo "checked"; } else { echo ""; } ?>> Male &nbsp;&nbsp;
                                                    <input type="radio"  name="gender" value="F" <?php if ($profile->gender == 'F') { echo "checked"; } else { echo ""; } ?>> Female
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Physical Status:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="physical_status" value="{{$profile->physical_status}}" oninput="this.className = ''">
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
                                                            <input oninput="this.className = ''" type="text" name="heightfeet" id="heightfeet" value="<?php echo ($profile->height != null) ? $heights[0] : "" ?>" onblur="validateNumber('heightfeet')"> feet
                                                        </div>
                                                        <div class="inputText_block1">
                                                            <input oninput="this.className = ''" type="text" name="heightinches" id="heightinches" value="<?php echo ($profile->height != null) ? $heights[1] : "" ?>" onblur="validateNumber('heightinches')"> inches
                                                        </div>
                                                    </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Weight:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">    
                                                <input type="text" name="weight" id="weight" value="{{$profile->weight}}" oninput="this.className = ''" onblur="validateNumber('weight')">
                                            </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table class="table_working_hours">
                                    <br>
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Hobby:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="hobby" value="{{$profile->hobby}}" oninput="this.className = ''">
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
                                            <td class="day_label">Specs:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio"  name="specs" value="1" <?php if ($profile->specs == '1') { echo "checked"; } else { echo ""; } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio"  name="specs" value="0" <?php if ($profile->specs == '0') { echo "checked"; } else { echo ""; } ?>> No
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Vegetarian:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio"  name="vegetarian" value="1" <?php if ($profile->vegetarian == '1') { echo "checked"; } else { echo ""; } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio"  name="vegetarian" value="0" <?php if ($profile->vegetarian == '0') { echo "checked"; } else { echo ""; } ?>> No
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Non-Vegetarian:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio"  name="non_vegetarian" value="1" <?php if ($profile->non_vegetarian == '1') { echo "checked"; } else { echo ""; } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio"  name="non_vegetarian" value="0" <?php if ($profile->non_vegetarian == '0') { echo "checked"; } else { echo ""; } ?>> No
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Eggetarian:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio"  name="eggetarian" value="1" <?php if ($profile->eggetarian == '1') { echo "checked"; } else { echo ""; } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio"  name="eggetarian" value="0" <?php if ($profile->eggetarian == '0') { echo "checked"; } else { echo ""; } ?>> No
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Drink:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio"  name="drink" value="1" <?php if ($profile->drink == '1') { echo "checked"; } else { echo ""; } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio"  name="drink" value="0" <?php if ($profile->drink == '0') { echo "checked"; } else { echo ""; } ?>> No
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Smoke:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio"  name="smoke" value="1" <?php if ($profile->smoke == '1') { echo "checked"; } else { echo ""; } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio"  name="smoke" value="0" <?php if ($profile->smoke == '0') { echo "checked"; } else { echo ""; } ?>> No
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Describe Yourself:</td>
                                            <td class="day_value">
                                                <textarea oninput="this.className = ''" name="self_description">{{$profile->self_description}}</textarea>
                                            </td>
                                        </tr>
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
                                    </tbody>
                                </table>
                            </div>
                            <br />
                            <h3>Religious / Social & Astro Background</h3>
                            <div class="col-sm-6">
                                <table class="table_working_hours">
                                    <tbody>

                                        <tr class="opened_1">
                                            <td class="day_label">Subcast:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="subcast" value="{{$profile->subcast}}" oninput="this.className = ''">
                                            </div>
                                            </td>

                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Date:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="birth_date" id="datepicker-3" placeholder="Select Date..." value="{{$profile->birth_date}}" onchange="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Time:</td>
                                            <td class="day_value">
                                            <div class = "select-block1timepicker">
                                                <select id="hour" name = "hour" > 
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
                                                    <select id="minute" name = "minute" > 
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
                                                    <select id="second" name = "second" > 
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
                                                    <select id="format" name ="format">
                                                        <option value="AM">AM</option>
                                                        <option value="PM">PM</option>
                                                    </select>
                                                    
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Place:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="birth_place" value="{{$profile->birth_place}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>

                                        <tr class="opened_1">
                                            <td class="day_label">Native:</td>
                                            <td class="day_value"> 
                                            <div class = "inputText_block1">
                                                <input type="text" name="native" value="{{$profile->native}}" oninput="this.className = ''">
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
                                                    <input type="radio"  name="mangal" value="1" <?php if ($profile->mangal == '1') { echo "checked"; } else { echo ""; } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio"  name="mangal" value="0" <?php if ($profile->mangal == '0') { echo "checked"; } else { echo ""; } ?>> No
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Shani:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio"  name="shani" value="1" <?php if ($profile->shani == '1') { echo "checked"; } else { echo ""; } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio"  name="shani" value="0" <?php if ($profile->shani == '0') { echo "checked"; } else { echo ""; } ?>> No
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!--------------------Education & Career-------------------------------------->
                        <div class="tab">
                            <div class="col-sm-6">
                                <h3>Education & Career</h3>
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
                                        <tr class="opened_1">
                                            <td class="day_label">Occupation :</td>
                                            <td class="day_value">
                                            <div class="select-block1">
                                                <select name = "occupation" id="occupation" onchange="showHideDevOccupation()">
                                                    <option value="Job">Job</option>
                                                    <option value="Business">Business</option>
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
                                            <div class = "inputText_block1" id="divAreaOfBusiness" style="display: <?php echo ($profile->occupation == 'Job') ? "none" : "block" ?>">
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
                                            <div class = "inputText_block1" id="divDesignation" style="display: <?php echo ($profile->occupation == 'Job') ? "block" : "none" ?>">
                                                <input class="optional valid" type="text" name="designation" id="designation" value="{{$profile->designation}}" id="designation" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Company Name :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="company_name" value="{{$profile->company_name}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Annual Income :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="annual_income" id="annual_income" value="{{$profile->annual_income}}" oninput="this.className = ''" onblur="validateNumber('annual_income')">
                                            </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--------------------Communication Details----------------------------------->
                        <div class="tab">
                            <div class="col-sm-12">
                                <h3>Communication Details</h3>
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Email Address :</td>
                                            <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <input type="text" name="email" value = "{{$profile->user->email}}" disabled>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Contact Number :</td>
                                            <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <input type="text" name="contact_no" id="contact_no" value="{{$profile->contact_no}}" oninput="this.className = ''" onblur="validateContactNumber('contact_no')">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-sm-6">
                                <br>
                                <h3>Present Details</h3>
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Present Address :</td>
                                            <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <textarea oninput="this.className = ''" name="present_address" id="present_address">{{$profile->present_address}}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present City :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_city" id="present_city" value="{{$profile->present_city}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present Taluka :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_taluka" id="present_taluka" value="{{$profile->present_taluka}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present District :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_district" id="present_district" value="{{$profile->present_district}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present State :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_state" id="present_state" value="{{$profile->present_state}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present Country :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_country" id="present_country" value="{{$profile->present_country}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present Pincode :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_pincode" id="present_pincode" value="{{$profile->present_pincode}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-sm-6">
                                <br>
                                <h3>Permanent Details</h3>
                                <table class="table_working_hours">
                                    <tbody>
                                    <tr class="opened_1">
                                            <input type="checkbox" name="sameAddress" class="radio_1" id="sameAddress" onclick="sameAddressAction()"/> Same as Present Address &nbsp;&nbsp;
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent Address :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <textarea name="permanent_address" id="permanent_address" oninput="this.className = ''">{{$profile->permanent_address}}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent City :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_city" id="permanent_city" value="{{$profile->permanent_city}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent Taluka :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_taluka" id="permanent_taluka" value="{{$profile->permanent_taluka}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent District :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_district" id="permanent_district" value="{{$profile->permanent_district}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent State :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">    
                                                <input type="text" name="permanent_state" id="permanent_state" value="{{$profile->permanent_state}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent Country :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_country" id="permanent_country" value="{{$profile->permanent_country}}" oninput="this.className = ''">
                                            </div>
                                            </td>

                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent Pincode :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_pincode" id="permanent_pincode" value="{{$profile->permanent_pincode}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--------------------Family Details------------------------------------------>
                        <div class="tab">

                            <div class="col-sm-6">
                                <div class="basic_3">
                                    <h4>Family Details</h4>
                                    <table class="table_working_hours">
                                        <tbody>
                                            <br>
                                            <h3> Father's Details </h3>
                                            <tr class="opened_1">
                                                <td class="day_label">Father's Name :</td>
                                                <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <input type="text" name="father_name" value="{{$profile->father_name}}" oninput="this.className = ''">
                                                </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Father's Ocuupation :</td>
                                                <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <input type="text" name="father_occupation" value="{{$profile->father_occupation}}" oninput="this.className = ''">
                                                </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Father's Annual Income :</td>
                                                <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <input type="text" name="father_annual_income" id="father_annual_income" value="{{$profile->father_annual_income}}" oninput="this.className = ''" onblur="validateNumber('father_annual_income')">
                                                </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Father's Contact Number :</td>
                                                <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <input type="text" name="father_contact_no" id="father_contact_no" value="{{$profile->father_contact_no}}" oninput="this.className = ''" onblur="validateContactNumber('father_contact_no')">
                                                </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <table class="table_working_hours">
                                    <tbody>
                                        <br><br> <br>
                                        <h3> Mother' Details </h3>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Name :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="mother_name" value="{{$profile->mother_name}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Ocuupation :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="mother_occupation" value="{{$profile->mother_occupation}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Annual Income :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="mother_annual_income" id="mother_annual_income" value="{{$profile->mother_annual_income}}" oninput="this.className = ''" onblur="validateNumber('mother_annual_income')">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Contact Number :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="mother_contact_no" id="mother_contact_no" value="{{$profile->mother_contact_no}}" oninput="this.className = ''" onblur="validateContactNumber('mother_contact_no')">
                                            </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table class="table_working_hours">
                                    <tbody>
                                        <br><br> <br>
                                        <h3> Brothers & Sister's Details </h3>
                                        <tr class="opened_1">
                                            <td class="day_label">No. Of Brothers :</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="no_of_brothers" name="no_of_brothers">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">No. Of Sisters :</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="no_of_sisters" name="no_of_sisters">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--------------------Review & Submit---------------------------------------->

                    </div>
                    <!------------------------Buttons Previous Next---------------------------------------->
                    <div class="col-sm-12">
                        <div style="overflow:auto;">
                            <div style="float:right;">
                                <button type="button" class="btn_1 submit" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                <button type="button" class="btn_1 submit" id="nextBtn" onclick="nextPrev(1)">Next</button>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------------------------->
                </div>
            </div>


            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>

            </div>

        </div>
    </div>
</form>
<script src="/js/multiform.js"></script>
<script>
function setSelectedIndex(s, v) {
    for ( var i = 0; i < s.options.length; i++ ) {
        if ( s.options[i].value == v ) {
            s.options[i].selected = true;
            return;
        }
    }
    var opt = document.createElement('option');
    opt.text = v;
    opt.value = v; 
    s.add(opt); 
    setSelectedIndex(s,v);
}


setSelectedIndex(document.getElementById('complexion'), "<?php echo $profile->complexion ?>");
setSelectedIndex(document.getElementById('profile_created_by'),"<?php echo $profile->profile_created_by ?>");
setSelectedIndex(document.getElementById('marital_status'),"<?php echo $profile->marital_status ?>");
setSelectedIndex(document.getElementById('rashi'),"<?php echo $profile->rashi ?>");
setSelectedIndex(document.getElementById('education'),"<?php echo $profile->education ?>");
setSelectedIndex(document.getElementById('occupation'),"<?php echo $profile->occupation ?>");
setSelectedIndex(document.getElementById('no_of_brothers'),"<?php echo $profile->no_of_brothers ?>");
setSelectedIndex(document.getElementById('no_of_sisters'),"<?php echo $profile->no_of_sisters ?>");

<?php
    $time = $profile->birth_time;
    $timeArray = explode(':',$time);
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
?>
setSelectedIndex(document.getElementById('hour'),"<?php echo $hr ?>");
setSelectedIndex(document.getElementById('minute'),"<?php echo $min ?>");
setSelectedIndex(document.getElementById('second'),"<?php echo $sec?>");
setSelectedIndex(document.getElementById('format'),"<?php echo $ampm?>");


function showImages() {
    var fileInput = document.getElementById('profile_pic');
    var files = fileInput.files;

    if (files.length != 0) {
        var divOldProfiles = document.getElementById("divOldProfiles");
        divOldProfiles.style.display = "none";
    }

    for(i=0 ; i < files.length ; i++) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(files[i]);

        oFReader.onload = function (oFREvent) {
            var imgElement = document.createElement("img");
            document.getElementById("profileImageDiv").appendChild(imgElement);
            imgElement.src = oFREvent.target.result;
            imgElement.width = 100;
            imgElement.height = 100;
            imgElement.id = "img" + i;
        }
    }
}

function ShowHideDivProfileCreatedBy() {
        var profile_created_by = document.getElementById("profile_created_by");
        var divProfileCreatedBy = document.getElementById("divProfileCreatedBy");
        divProfileCreatedBy.style.display = profile_created_by.value == "Others" ? "block" : "none";
        var inputProfileCreatedByOthers = document.getElementById("profile_created_by_others");
        inputProfileCreatedByOthers.className = profile_created_by.value == "Others" ? "optional invalid" : "optional valid";
        if (profile_created_by.value != "Others") {
            inputProfileCreatedByOthers.value = "";
        }
    }

function ShowHideDivEducation() {
        var education = document.getElementById("education");
        var divEducation = document.getElementById("divEducation");
        divEducation.style.display = education.value == "Others" ? "block" : "none";
        var inputEducation = document.getElementById("education_others");
        inputEducation.className = education.value == "Others" ? "optional invalid" : "optional valid";
        if (education.value != "Others") {
            inputEducation.value = "";
        }
    }

function showHideDevOccupation() {
        var occupation = document.getElementById("occupation");

        var divAreaOfBusiness = document.getElementById("divAreaOfBusiness");
        divAreaOfBusiness.style.display = occupation.value == "Business" ? "block" : "none";

        var divDesignation = document.getElementById("divDesignation");
        divDesignation.style.display = occupation.value == "Job" ? "block" : "none";

        var divAreaOfBusinessLabel = document.getElementById("divAreaOfBusinessLabel");
        divAreaOfBusinessLabel.style.display = occupation.value == "Business" ? "block" : "none";

        var divDesignationLabel = document.getElementById("divDesignationLabel");
        divDesignationLabel.style.display = occupation.value == "Job" ? "block" : "none";

        var inputAreaOfBusiness = document.getElementById("area_of_business");
        var inputDesignation = document.getElementById("designation");
        inputAreaOfBusiness.className = occupation.value == "Business" ? "optional invalid" : "optional valid";
        inputDesignation.className = occupation.value == "Job" ? "optional invalid" : "optional valid";
        if (occupation.value != "Business") {
            inputAreaOfBusiness.value = "";
        }
        if (occupation.value != "Job") {
            inputDesignation.value = "";
        }
    }

function sameAddressAction() {
        var sameAddressCheckbox = document.getElementById('sameAddress');
        if (sameAddressCheckbox.checked == true) {
            document.getElementById('permanent_address').value = document.getElementById('present_address').value;
            document.getElementById('permanent_city').value = document.getElementById('present_city').value;
            document.getElementById('permanent_taluka').value = document.getElementById('present_taluka').value;
            document.getElementById('permanent_district').value = document.getElementById('present_district').value;
            document.getElementById('permanent_state').value = document.getElementById('present_state').value;
            document.getElementById('permanent_country').value = document.getElementById('present_country').value;
            document.getElementById('permanent_pincode').value = document.getElementById('present_pincode').value;

            document.getElementById('permanent_address').readOnly  = true;
            document.getElementById('permanent_city').readOnly  = true;
            document.getElementById('permanent_taluka').readOnly  = true;
            document.getElementById('permanent_district').readOnly = true;
            document.getElementById('permanent_state').readOnly  = true;
            document.getElementById('permanent_country').readOnly  = true;
            document.getElementById('permanent_pincode').readOnly  = true;
            
            document.getElementById('permanent_address').className = '';
            document.getElementById('permanent_city').className = '';
            document.getElementById('permanent_taluka').className = '';
            document.getElementById('permanent_district').className = '';
            document.getElementById('permanent_state').className = '';
            document.getElementById('permanent_country').className = '';
            document.getElementById('permanent_pincode').className = '';

        } else {
            document.getElementById('permanent_address').value = "";
            document.getElementById('permanent_city').value = "";
            document.getElementById('permanent_taluka').value = "";
            document.getElementById('permanent_district').value = "";
            document.getElementById('permanent_state').value = "";
            document.getElementById('permanent_country').value = "";
            document.getElementById('permanent_pincode').value = "";
            
            document.getElementById('permanent_address').readOnly  = false;
            document.getElementById('permanent_city').readOnly  = false;
            document.getElementById('permanent_taluka').readOnly  = false;
            document.getElementById('permanent_district').readOnly = false;
            document.getElementById('permanent_state').readOnly  = false;
            document.getElementById('permanent_country').readOnly  = false;
            document.getElementById('permanent_pincode').readOnly  = false;
        }
    }
    function validateNumber(input) {
        var inputValue = document.getElementById(input).value;
        if (isNaN(inputValue)) {
            alert("Invalid value: " + inputValue + ", Please enter numeric value.");
            setTimeout(function () {document.getElementById(input).focus();}, 10);
        }
    }

    function validateContactNumber(input) {
        var inputValue = document.getElementById(input).value;
        contactChars = Array.from(inputValue);

        for (i=0 ; i < contactChars.length ; i++) {
            if (isNaN(contactChars[i]) && contactChars[i] != ' ' && contactChars[i] != '-' && contactChars[i] != '+') {
                alert("Invalid value: " + inputValue + ", Please enter valid contact number.");
                setTimeout(function () {document.getElementById(input).focus();}, 10);
                break;
            } 
        }
    }
</script>
@endsection