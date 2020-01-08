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
                                                    <input type="file" name="profile_pic_path[]" id="profile_pic" onchange="showImages()" multiple>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label"><label>Images: </label></td>
                                            <td class="day_value">
                                                <div class="img" id="profileImageDiv">

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                            <div id="divOldProfiles" style="display: block">
                                            <?php
                                            if ($profile->profile_pic_path != null) {
								                $profile_pic_paths = explode(",",$profile->profile_pic_path);
								                foreach($profile_pic_paths as $profile_pic_path) {
								                	?>
								                	<img src="/storage/profile_images/thumbnail/{{$profile_pic_path}}"/>
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
                                                <div class="select-block1">
                                                    <select id="gender" name="gender">
                                                        <option value="M">Male</option>
                                                        <option value="F">Female</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="opened_1">
                                            <td class="day_label">Physical Status:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="physical_status" value="{{$profile->physical_status}}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Height:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">    
                                                <input type="text" name="height" value="{{$profile->height}}">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Weight:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">    
                                                <input type="text" name="weight" value="{{$profile->weight}}">
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
                                                <input type="text" name="hobby" value="{{$profile->hobby}}">
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
                                                <div class="select-block1">
                                                    <select id="specs" name="specs">
                                                        <option value="1">YES</option>
                                                        <option value="0">NO</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Vegetarion:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="vegetarion" name="vegetarion">
                                                        <option value="1">YES</option>
                                                        <option value="0">NO</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Non-Vegetarion:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="non_vegetarion" name="non_vegetarion">
                                                        <option value="1">YES</option>
                                                        <option value="0">NO</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Eggetarion:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="eggetarion" name="eggetarion">
                                                        <option value="1">YES</option>
                                                        <option value="0">NO</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Drink:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="drink" name="drink">
                                                        <option value="1">YES</option>
                                                        <option value="0">NO</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Smoke:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="smoke" name="smoke">
                                                        <option value="1">YES</option>
                                                        <option value="0">NO</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Describe Yourself:</td>
                                            <td class="day_value">
                                                <textarea name="self_description">{{$profile->self_description}}</textarea>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Profile Created By:</td>
                                            <td class="day_value">
                                            <div class="select-block1">
                                                <select id="profile_created_by" name="profile_created_by">
                                                    <option value="Self">Self</option>
                                                    <option value="Sibling">Sibling</option>
                                                    <option value="Parent/Guadian">Parent/Guadian</option>
                                                    <option value="Others">Others</option>
                                                </select>
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
                                                <input type="text" name="subcast" value="{{$profile->subcast}}">
                                            </div>
                                            </td>

                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Date:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="birth_date" id="datepicker-3" placeholder="Select Date..." value="{{$profile->birth_date}}">
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
                                                <input type="text" name="birth_place" value="{{$profile->birth_place}}">
                                            </div>
                                            </td>
                                        </tr>

                                        <tr class="opened_1">
                                            <td class="day_label">Native:</td>
                                            <td class="day_value"> 
                                            <div class = "inputText_block1">
                                                <input type="text" name="native" value="{{$profile->native}}">
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
                                                <div class="select-block1">
                                                    <select id="mangal" name="mangal" placeholder="Select YES/NO">
                                                        <option value="1">YES</option>
                                                        <option value="0">NO</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Shani:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="shani" name="shani">
                                                        <option value="1">YES</option>
                                                        <option value="0">NO</option>
                                                    </select>
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
                                            <td class="day_label">Highest Education :</td>
                                            <td class="day_value">
                                            <div class="select-block1">
                                                <select id="highest_education" name="highest_education">
                                                    <option value="Below SSC">Below SSC</option>
                                                    <option value="SSC">SSC</option>
                                                    <option value="HSC">HSC</option>
                                                    <option value="Bachelor">Bachelor</option>
                                                    <option value="Masters">Masters</option>
                                                    <option value="Ph.D">Ph.D</option>
                                                </select>
                                            </div>
                                        </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Education Details :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="education_details" value="{{$profile->education_details}}">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Occupation :</td>
                                            <td class="day_value">
                                            <div class="select-block1">
                                                <select id="occupation" name = "occupation">
                                                    <option value="Job">Job</option>
                                                    <option value="Business">Business</option>
                                                </select>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Area of Bussiness :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="area_of_business" value="{{$profile->area_of_business}}">
                                            </div>
                                            </td>
                                        </tr>

                                        <tr class="opened_1">
                                            <td class="day_label">Designation :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="designation" value="{{$profile->designation}}">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Company Name :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="company_name" value="{{$profile->company_name}}">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Annual Income :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="annual_income" value="{{$profile->annual_income}}">
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
                                                <input type="text" name="email" value = "{{$profile->user->email}}" disabled>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Contact Number :</td>
                                            <td class="day_value">
                                                <input type="text" name="contact_no" value="{{$profile->contact_no}}">
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
                                            <td class="day_value"><textarea name="present_address">{{$profile->present_address}}</textarea></td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present City :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_city" value="{{$profile->present_city}}">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present Taluka :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_taluka" value="{{$profile->present_taluka}}">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present District :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_district" value="{{$profile->present_district}}">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present State :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_state" value="{{$profile->present_state}}">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present Country :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_country" value="{{$profile->present_country}}">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present Pincode :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_pincode" value="{{$profile->present_pincode}}">
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
                                            <td class="day_label">Permanent Address :</td>
                                            <td class="day_value"><textarea name="permanent_address">{{$profile->permanent_address}}</textarea></td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent City :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_city" value="{{$profile->permanent_city}}">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent Taluka :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_taluka" value="{{$profile->permanent_taluka}}">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent District :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_district" value="{{$profile->permanent_district}}">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent State :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">    
                                                <input type="text" name="permanent_state" value="{{$profile->permanent_state}}">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent Country :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_country" value="{{$profile->permanent_country}}">
                                            </div>
                                            </td>

                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent Pincode :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_pincode" value="{{$profile->permanent_pincode}}">
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
                                                    <input type="text" name="father_name" value="{{$profile->father_name}}">
                                                </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Father's Ocuupation :</td>
                                                <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <input type="text" name="father_occupation" value="{{$profile->father_occupation}}">
                                                </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Father's Annual Income :</td>
                                                <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <input type="text" name="father_annual_income" value="{{$profile->father_annual_income}}">
                                                </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Father's Contact Number :</td>
                                                <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <input type="text" name="father_contact_no" value="{{$profile->father_contact_no}}">
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
                                                <input type="text" name="mother_name" value="{{$profile->mother_name}}">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Ocuupation :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="mother_occupation" value="{{$profile->mother_occupation}}">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Annual Income :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="mother_annual_income" value="{{$profile->mother_annual_income}}">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Contact Number :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="mother_contact_no" value="{{$profile->mother_contact_no}}">
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
}

setSelectedIndex(document.getElementById('gender'), "<?php echo $profile->gender ?>");
setSelectedIndex(document.getElementById('complexion'), "<?php echo $profile->complexion ?>");
setSelectedIndex(document.getElementById('specs'),"<?php echo $profile->specs ?>");
setSelectedIndex(document.getElementById('vegetarion'),"<?php echo $profile->vegetarion ?>");
setSelectedIndex(document.getElementById('non_vegetarion'),"<?php echo $profile->non_vegetarion ?>");
setSelectedIndex(document.getElementById('eggetarion'),"<?php echo $profile->eggetarion ?>");
setSelectedIndex(document.getElementById('drink'),"<?php echo $profile->drink ?>");
setSelectedIndex(document.getElementById('smoke'),"<?php echo $profile->smoke ?>");
setSelectedIndex(document.getElementById('profile_created_by'),"<?php echo $profile->profile_created_by ?>");
setSelectedIndex(document.getElementById('marital_status'),"<?php echo $profile->marital_status ?>");
setSelectedIndex(document.getElementById('rashi'),"<?php echo $profile->rashi ?>");
setSelectedIndex(document.getElementById('mangal'),"<?php echo $profile->mangal ?>");
setSelectedIndex(document.getElementById('shani'),"<?php echo $profile->shani ?>");
setSelectedIndex(document.getElementById('highest_education'),"<?php echo $profile->highest_education ?>");
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
</script>
@endsection