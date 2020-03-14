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
                            <div class="basic_3">
                                <h4>About Myself</h4>
                            </div>
                            <hr>
                            <h3 class="profile_title">
                                <div style="margin: 5px; padding: 5px;"><b>Appearance</b></div>
                            </h3>
                            <div class="row">
                                <div class="col-sm-5">
                                    <table class="table_working_hours">
                                        <tbody>
                                            <tr class="opened_1">
                                                <td class="day_value" colspan="2">
                                                    <div class="img" id="profileImageDiv">
                                                        <table>
                                                            <tr>
                                                                <td colspan="4">
                                                                    <?php
                                                                    $totalPics = 0;
                                                                    if ($profile->profile_pic_path != null) {
                                                                        $profile_pic_paths = explode(",", $profile->profile_pic_path);
                                                                        $totalPics = sizeof($profile_pic_paths);
                                                                        if ($totalPics != 0) {
                                                                            ?>
                                                                            <img id='mainimage' src='/storage/profile_images/mainimage/{{$profile_pic_paths[0]}}' width='300' height='305'>
                                                                        <?php
                                                                            } else {
                                                                                ?>
                                                                            <img id='mainimage' src='/images/blank-profile-picture.png' width='300' height='300'>
                                                                        <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                        <img id='mainimage' src='/images/blank-profile-picture.png' width='300' height='300'>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <?php
                                                                $totalPics = 0;
                                                                if ($profile->profile_pic_path != null) {
                                                                    $profile_pic_paths = explode(",", $profile->profile_pic_path);
                                                                    $totalPics = sizeof($profile_pic_paths);
                                                                    $i = 1;
                                                                    foreach ($profile_pic_paths as $profile_pic_path) {
                                                                        ?>
                                                                        <td>
                                                                            <img id="image{{$i}}" width="73" height="63" src="/storage/profile_images/thumbnail/{{$profile_pic_path}}" onclick="showInMainImage('image{{$i}}')" />&nbsp;
                                                                        </td>
                                                                    <?php
                                                                            $i++;
                                                                        }
                                                                    }
                                                                    for ($i = $totalPics + 1; $i <= 4; $i++) {
                                                                        ?>
                                                                    <td>
                                                                        <img id="image{{$i}}" width="73" height="63" src="/images/blank-profile-picture.png" onclick="showInMainImage('image{{$i}}')" />&nbsp;
                                                                    </td>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: center">
                                                                    <label id="AddImage1" class="button_add button4" data-toggle="tooltip" data-placement="bottom" title="Add first image"><i class="fa fa-plus" aria-hidden="true"></i></label>
                                                                    <label id="RemoveImage1" class="button_remove button4" data-toggle="tooltip" data-placement="bottom" title="Remove first image"><i class="fa fa-trash-o" aria-hidden="true"></i></label>
                                                                </td>
                                                                <td style="text-align: center">
                                                                    <label id="AddImage2" class="button_add button4" data-toggle="tooltip" data-placement="bottom" title="Add second image"><i class="fa fa-plus" aria-hidden="true"></i></label>
                                                                    <label id="RemoveImage2" class="button_remove button4" data-toggle="tooltip" data-placement="bottom" title="Remove second image"><i class="fa fa-trash-o" aria-hidden="true"></i></label>
                                                                </td>
                                                                <td style="text-align: center">
                                                                    <label id="AddImage3" class="button_add button4" data-toggle="tooltip" data-placement="bottom" title="Add third image"><i class="fa fa-plus" aria-hidden="true"></i></label>
                                                                    <label id="RemoveImage3" class="button_remove button4" data-toggle="tooltip" data-placement="bottom" title="Remove third image"><i class="fa fa-trash-o" aria-hidden="true"></i></label>
                                                                </td>
                                                                <td style="text-align: center">
                                                                    <label id="AddImage4" class="button_add button4" data-toggle="tooltip" data-placement="bottom" title="Add fourth image"><i class="fa fa-plus" aria-hidden="true"></i></label>
                                                                    <label id="RemoveImage4" class="button_remove button4" data-toggle="tooltip" data-placement="bottom" title="Remove fourth image"><i class="fa fa-trash-o" aria-hidden="true"></i></label>
                                                                </td>
                                                            </tr>
                                                            <input type="text" class="optional valid" name="removeFilesList" id="removeFilesList" value="" hidden>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <ul class="login_details1">
                                        <li>
                                            <label style="color: #c32143; margin: 10px">
                                                Upload square images for best view (e.g, 2611 X 2611).<br>Use croppola to crop images.
                                            </label>
                                        </li>
                                    </ul>
                                    
                                </div>
                                <div class="col-sm-7">
                                <table class="table_working_hours">
                                        <tbody>
                                            <br>
                                            <tr class="opened_1">
                                                <td class="day_label">
                                                    <h3>Name:</h3>
                                                </td>
                                                <td class="day_value">
                                                    <div class="inputText_block1">
                                                        <h3><b>{{Auth::user()->name}} {{Auth::user()->lastname}}</b></h3>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label"><b>Profile No:</b></td>
                                                <td class="day_value">
                                                    <b>{{$profile->id}}</b>
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
                                                <td class="day_value">
                                                    <div id="divImage1" class="inputText_block1" style="display: none">
                                                        <input class="optional <?php echo ($profile->profile_pic_path == null) ? "valid" : "valid" ?>" type="file" name="profile_pic_path1" id="profile_pic1" oninput="this.className = 'optional valid'" onchange="showImages(1)" accept="image/*">
                                                    </div>
                                                    <div id="divImage2" class="inputText_block1" style="display: none">
                                                        <input class="optional <?php echo ($profile->profile_pic_path == null) ? "valid" : "valid" ?>" type="file" name="profile_pic_path2" id="profile_pic2" oninput="this.className = 'optional valid'" onchange="showImages(2)" accept="image/*">
                                                    </div>
                                                    <div id="divImage3" class="inputText_block1" style="display: none">
                                                        <input class="optional <?php echo ($profile->profile_pic_path == null) ? "valid" : "valid" ?>" type="file" name="profile_pic_path3" id="profile_pic3" oninput="this.className = 'optional valid'" onchange="showImages(3)" accept="image/*">
                                                    </div>
                                                    <div id="divImage4" class="inputText_block1" style="display: none">
                                                        <input class="optional <?php echo ($profile->profile_pic_path == null) ? "valid" : "valid" ?>" type="file" name="profile_pic_path4" id="profile_pic4" oninput="this.className = 'optional valid'" onchange="showImages(4)" accept="image/*">
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
                                                                <input oninput="this.className = ''" type="text" name="heightfeet" id="heightfeet" value="<?php echo ($profile->height != null && sizeof($heights) >= 1) ? $heights[0] : "0" ?>" onblur="validateNumber('heightfeet')"> feet
                                                            </div>
                                                            <div class="oneline">
                                                                <input oninput="this.className = ''" type="text" name="heightinches" id="heightinches" value="<?php echo ($profile->height != null && sizeof($heights) == 2) ? $heights[1] : "0" ?>" onblur="validateNumber('heightinches')"> inches
                                                            </div>
                                                            </div>
                                                        </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Weight:</td>
                                                <td class="day_value">
                                                <div class = "inputText_block1" style="width: 120px">    
                                                    <input type="text" name="weight" id="weight" value="{{$profile->weight}}" oninput="this.className = ''" onblur="validateNumber('weight')"> Kgs
                                                </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Specs:</td>
                                                <td class="day_value">
                                                    <div class="form_radios">
                                                        <input type="radio"  name="specs" value="Yes" <?php if ($profile->specs == 'Yes') { echo "checked"; } else { echo ""; } ?>> Yes &nbsp;&nbsp;
                                                        <input type="radio"  name="specs" value="No" <?php if ($profile->specs == 'No') { echo "checked"; } else { echo ""; } ?>> No &nbsp;&nbsp;
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
                                            <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Describe Yourself</b></div></h3>
                                            <tr class="opened_1">
                                                <td class="day_value">
                                                    <div class="container2">
                                                        <div class="comment">
                                                            <textarea class="textinput" cols="130" rows="5" maxlength="250" oninput="this.className = ''" name="self_description">{{$profile->self_description}}</textarea>
                                                        </div>
                                                        <div style="text-align: right">
                                                            You can write upto 250 characters
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
                                <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Basic Details</b></div></h3>
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
                                                        <option>Singing</option>
                                                        <option>Reading</option>
                                                        <option>Writing</option>
                                                        <option>Photography</option>
                                                        <option>Painting</option>
                                                        <option>Sewing</option>
                                                        <option>Gardening</option>
                                                        <option>Exercise</option>
                                                        <option>Hiking</option>
                                                        <option>Crochet</option>
                                                        <option>Stamp Collecting</option>
                                                        <option>Playing Games</option>
                                                        <option>Shopping</option>
                                                        <option>Others</option>
                                                    </select>
                                                </div>
                                                <div id="divHobby" class="inputText_block1" style="display: none">
                                                    <input class="optional valid" type="text" name="hobby_others" maxlength="250" id="hobby_others" value="{{$profile->hobby}}" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Subcaste:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="subcast" value="{{$profile->subcast}}" oninput="this.className = ''">
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
                                <div class="col-sm-1">&nbsp;</div>
                                <div class="col-sm-5">
                                <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Life Style</b></div></h3>
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Drink:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio"  name="drink" value="Yes" <?php if ($profile->drink == 'Yes') { echo "checked"; } else { echo ""; } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio"  name="drink" value="No" <?php if ($profile->drink == 'No') { echo "checked"; } else { echo ""; } ?>> No &nbsp;&nbsp;
                                                    <input type="radio"  name="drink" value="Occasionally" <?php if ($profile->drink == 'Occasionally') { echo "checked"; } else { echo ""; } ?>> Occasionally
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Smoke:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio"  name="smoke" value="Yes" <?php if ($profile->smoke == 'Yes') { echo "checked"; } else { echo ""; } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio"  name="smoke" value="No" <?php if ($profile->smoke == 'No') { echo "checked"; } else { echo ""; } ?>> No &nbsp;&nbsp;
                                                    <input type="radio"  name="smoke" value="Occasionally" <?php if ($profile->smoke == 'Occasionally') { echo "checked"; } else { echo ""; } ?>> Occasionally
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Vegetarian:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio"  name="vegetarian" value="Yes" <?php if ($profile->vegetarian == 'Yes') { echo "checked"; } else { echo ""; } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio"  name="vegetarian" value="No" <?php if ($profile->vegetarian == 'No') { echo "checked"; } else { echo ""; } ?>> No &nbsp;&nbsp;
                                                    <input type="radio"  name="vegetarian" value="Occasionally" <?php if ($profile->vegetarian == 'Occasionally') { echo "checked"; } else { echo ""; } ?>> Occasionally
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Non-Vegetarian:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio"  name="non_vegetarian" value="Yes" <?php if ($profile->non_vegetarian == 'Yes') { echo "checked"; } else { echo ""; } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio"  name="non_vegetarian" value="No" <?php if ($profile->non_vegetarian == 'No') { echo "checked"; } else { echo ""; } ?>> No &nbsp;&nbsp;
                                                    <input type="radio"  name="non_vegetarian" value="Occasionally" <?php if ($profile->non_vegetarian == 'Occasionally') { echo "checked"; } else { echo ""; } ?>> Occasionally
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Eggetarian:</td>
                                            <td class="day_value">
                                                <div class="form_radios">
                                                    <input type="radio"  name="eggetarian" value="Yes" <?php if ($profile->eggetarian == 'Yes') { echo "checked"; } else { echo ""; } ?>> Yes &nbsp;&nbsp;
                                                    <input type="radio"  name="eggetarian" value="No" <?php if ($profile->eggetarian == 'No') { echo "checked"; } else { echo ""; } ?>> No &nbsp;&nbsp;
                                                    <input type="radio"  name="eggetarian" value="Occasionally" <?php if ($profile->eggetarian == 'Occasionally') { echo "checked"; } else { echo ""; } ?>> Occasionally
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <hr/>
                            <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Astro Details</b></div></h3>
                            <div class="row">
                                <div class="col-sm-6">
                                    <table class="table_working_hours">
                                        <tbody>
                                            <tr class="opened_1">
                                                <td class="day_label">Birth Date:</td>
                                                <td class="day_label">
                                                    <div class="inputText_block1">
                                                        <input type="text" name="birth_date" id="datepicker-3" placeholder="Select Date..." value="{{$profile->birth_date}}" onchange="this.className = ''" readonly>
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
                                                        <select id="rashi" name="rashi" placeholder="Select Rashi..." onchange="this.className = ''">
                                                            <option value="Aries or Maish">Aries or Maish</option>
                                                            <option value="Taurus or Vrishabh">Taurus or Vrishabh</option>
                                                            <option value="Gemini or Mithun">Gemini or Mithun</option>
                                                            <option value="Cancer or Kark">Cancer or Kark</option>
                                                            <option value="Leo or Sinh">Leo or Sinh</option>
                                                            <option value="Vigro or Kanya">Vigro or Kanya</option>
                                                            <option value="Libra or Tula">Libra or Tula</option>
                                                            <option value="Scorpio or Vruschik">Scorpio or Vruschik</option>
                                                            <option value="Sagittarius or Dhan">Sagittarius or Dhan</option>
                                                            <option value="Capricorn or Makar">Capricorn or Makar</option>
                                                            <option value="Aquarius or Kumbh">Aquarius or Kumbh</option>
                                                            <option value="Pisces or Meen">Pisces or Meen</option>
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
                            <hr>
                        </div>
                        <!--------------------Education & Career-------------------------------------->
                        <div class="tab">
                            <div class="basic_3">
                                <h4>Education & Career</h4>
                            </div>
                            <hr>
                            <div class="row">
                            <div class="col-sm-5">
                                <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Education</b></div></h3>
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
                                        <tr>
                                            <td colspan="2">
                                                <hr>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-5">
                                <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Career</b></div></h3>
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Occupation :</td>
                                            <td class="day_value">
                                            <div class="select-block1">
                                                <select name = "occupation" id="occupation" onchange="showHideDevOccupation()">
                                                    <option value="Job">Job</option>
                                                    <option value="Business">Business</option>
                                                    <option value="Home Maker">Home Maker</option>
                                                    <option value="Not Applicable (Studying)">Not Applicable (Studying)</option>
                                                    <option value="Not Applicable (Not Working)">Not Applicable (Not Working)</option>
                                                </select>
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
                                            <div class = "inputText_block1" id="divAreaOfBusiness" style="display: <?php echo ($profile->occupation == 'Business') ? "block" : "none" ?>">
                                                <input class="optional <?php echo ($profile->occupation == 'Business') ? "invalid" : "valid" ?>" type="text" name="area_of_business" id="area_of_business" value="{{$profile->area_of_business}}" id="area_of_business" oninput="this.className = ''">
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
                                                <input class="optional <?php echo ($profile->occupation == 'Job') ? "invalid" : "valid" ?>" type="text" name="designation" id="designation" value="{{$profile->designation}}" id="designation" oninput="this.className = ''">
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
                                                <div  class = "inputText_block1" id="divCompanyName" style="display: <?php echo ($profile->occupation == "Job" || $profile->occupation == "Business") ? "block" : "none" ?>">
                                                    <input class="optional <?php echo ($profile->occupation == "Job" || $profile->occupation == "Business") ? "invalid" : "valid" ?>" type="text" id="company_name" name="company_name" value="{{$profile->company_name}}" oninput="this.className = ''">
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
                                                <div class = "inputText_block1">
                                                    <div id="divAnnualIncome" style="display: <?php echo ($profile->occupation == "Job" || $profile->occupation == "Business") ? "block" : "none" ?>">
                                                        <input class="optional <?php echo ($profile->occupation == "Job" || $profile->occupation == "Business") ? "invalid" : "valid" ?>" type="text" name="annual_income" id="annual_income" value="{{$profile->annual_income}}" oninput="this.className = ''" onblur="validateNumber('annual_income')">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <hr>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <hr>
                        </div>
                        <!--------------------Communication Details----------------------------------->
                        <div class="tab">
                            <div class="basic_3">
                                <h4>Communication Details</h4>
                            </div>
                            <hr>
                            <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Contact Details</b></div></h3>
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
                                                    <div class = "inputText_block1">
                                                        <input type="text" name="contact_no" id="contact_no" value="{{$profile->contact_no}}" oninput="this.className = ''" onblur="validateContactNumber('contact_no')">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Present Address</b></div></h3>
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
                                                            <textarea class="textinput3" maxlength="250" oninput="this.className = 'textinput3'" name="present_address" id="present_address">{{$profile->present_address}}</textarea>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">City: </td>
                                                <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <input type="text" name="present_city" id="present_city" value="{{$profile->present_city}}" oninput="this.className = ''">
                                                </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Taluka: </td>
                                                <td class="day_value">
                                                <div class = "inputText_block1">
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
                                                <div class = "inputText_block1">
                                                    <input type="text" name="present_district" id="present_district" value="{{$profile->present_district}}" oninput="this.className = ''">
                                                </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">State: </td>
                                                <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <input type="text" name="present_state" id="present_state" value="{{$profile->present_state}}" oninput="this.className = ''">
                                                </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Country: </td>
                                                <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <input type="text" name="present_country" id="present_country" value="{{$profile->present_country}}" oninput="this.className = ''">
                                                </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Pincode: </td>
                                                <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <input type="text" name="present_pincode" id="present_pincode" value="{{$profile->present_pincode}}" oninput="this.className = ''">
                                                </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Permanent Address</b></div></h3>
                            <div class="row">
                                <div class="col-sm-12">
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <input type="checkbox" maxlength="250" name="sameAddress" class="radio_1" id="sameAddress" onclick="sameAddressAction()"/> <b><i> Same as Present Address</i></b> &nbsp;&nbsp;
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
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_city" id="permanent_city" value="{{$profile->permanent_city}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Taluka: </td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
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
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_district" id="permanent_district" value="{{$profile->permanent_district}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">State: </td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">    
                                                <input type="text" name="permanent_state" id="permanent_state" value="{{$profile->permanent_state}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Country: </td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_country" id="permanent_country" value="{{$profile->permanent_country}}" oninput="this.className = ''">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Pincode: </td>
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
                            <hr>
                        </div>
                        <!--------------------Family Details------------------------------------------>
                        <div class="tab">
                            <div class="basic_3">
                                <h4>Family Details</h4>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <table class="table_working_hours">
                                        <tbody>
                                            <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Father's Details</b></div></h3>
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
                                                    <input type="text" class="optional valid" name="father_annual_income" id="father_annual_income" value="{{$profile->father_annual_income}}" oninput="this.className = ''" onblur="validateNumber('father_annual_income')">
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
                                            <tr>
                                                <td colspan="2">
                                                    <hr>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>    
                                <div class="col-sm-1"></div>
                                <div class="col-sm-5">
                                    <table class="table_working_hours">
                                        <tbody>
                                            <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Mother' Details</b></h3>
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
                                                    <input type="text" class="optional valid" name="mother_annual_income" id="mother_annual_income" value="{{$profile->mother_annual_income}}" oninput="this.className = ''" onblur="validateNumber('mother_annual_income')">
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
                                            <tr>
                                                <td colspan="2">
                                                    <hr>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <table class="table_working_hours">
                                        <tbody>
                                            <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Brothers & Sisters</b></div></h3>
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
                        <!--------------------Review & Submit---------------------------------------->

                    </div>
                    <!------------------------Buttons Previous Next---------------------------------------->
                    <div id="processing" style="display: none; text-align: center; font-size: 30px">
                        <h3><i class="fa fa-spinner fa-pulse fa-1x fa-fw" aria-hidden="true"></i> Updating profile</h3>
                    </div>
                    <div class="col-sm-12">
                        <div style="overflow:auto;">
                            <div style="float:right;">
                                <button type="button" class="btn_1 submit" id="prevBtn" onclick="nextPrev(-1)" style="display: inline-block">Previous</button>
                                <button type="button" class="btn_1 submit" id="nextBtn" onclick="nextPrev(1)" style="display: inline-block">Next</button>
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

setSelectedIndex(document.getElementById('physical_status'), "<?php echo $profile->physical_status ?>");
setSelectedIndex(document.getElementById('hobby'),"<?php echo $profile->hobby ?>");
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

function showImages(identity) {
        var fileInput = document.getElementById('profile_pic' + identity);
        makeAllFileInputValid();
        var files = fileInput.files;
        for (i = 0; i < files.length; i++) {
            //enable the below code and test with our marriage images.
            
            if (files[i].size > 2000000) {
                alert("Image size is greater than 2MB. Please upload image which is less than 2MB.");
                return;
            }

                if(files[i].type.indexOf("image")==-1) {
                    alert("You can upload only images.");
                    return;
                }

            var oFReader = new FileReader();
            oFReader.readAsDataURL(files[i]);

            oFReader.onload = function(oFREvent) {
                var imageName = "image" + identity;
                var imgElement = document.getElementById(imageName);
                imgElement.src = oFREvent.target.result;
            }
        }
        setTimeout(function() {
            showInMainImage('image' + identity);
        }, 20);
    }

function makeAllFileInputValid() {
        document.getElementById('profile_pic1').className = "optional valid";
        document.getElementById('profile_pic2').className = "optional valid";
        document.getElementById('profile_pic3').className = "optional valid";
        document.getElementById('profile_pic4').className = "optional valid";
    }

function showInMainImage(image) {
        var imageFrom = document.getElementById(image);
        var mainImageElement = document.getElementById('mainimage');
        imagesrc = imageFrom.src;
        mainImageElement.src = imagesrc.replace("thumbnail", "mainimage");
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

function showHideDivHobby() {
        var hobby = document.getElementById("hobby");
        var divHobby = document.getElementById("divHobby");
        divHobby.style.display = hobby.value == "Others" ? "block" : "none";
        var inputHobby = document.getElementById("hobby_others");
        inputHobby.className = hobby.value == "Others" ? "optional invalid" : "optional valid";
        if (hobby.value != "Others") {
            inputHobby.value = "";
        }
    }

function showHideDevOccupation() {
        var occupation = document.getElementById("occupation");
        

        var divAreaOfBusinessLabel = document.getElementById("divAreaOfBusinessLabel");
        divAreaOfBusinessLabel.style.display = occupation.value == "Business" ? "block" : "none";
        var divAreaOfBusiness = document.getElementById("divAreaOfBusiness");
        divAreaOfBusiness.style.display = occupation.value == "Business" ? "block" : "none";

        var divDesignationLabel = document.getElementById("divDesignationLabel");
        divDesignationLabel.style.display = occupation.value == "Job" ? "block" : "none";
        var divDesignation = document.getElementById("divDesignation");
        divDesignation.style.display = occupation.value == "Job" ? "block" : "none";

        var divCompanyNameLabel = document.getElementById("divCompanyNameLabel");
        divCompanyNameLabel.style.display = (occupation.value == "Job" || occupation.value == "Business") ? "block" : "none";
        var divCompanyName = document.getElementById("divCompanyName");
        divCompanyName.style.display = (occupation.value == "Job" || occupation.value == "Business") ? "block" : "none";

        var divAnnualIncomeLabel = document.getElementById("divAnnualIncomeLabel");
        divAnnualIncomeLabel.style.display = (occupation.value == "Job" || occupation.value == "Business") ? "block" : "none";
        var divAnnualIncome = document.getElementById("divAnnualIncome");
        divAnnualIncome.style.display = (occupation.value == "Job" || occupation.value == "Business") ? "block" : "none";

        var inputAreaOfBusiness = document.getElementById("area_of_business");
        var inputDesignation = document.getElementById("designation");
        var inputCompanyName = document.getElementById("company_name");
        var inputAnnualIncome = document.getElementById("annual_income");

        inputAreaOfBusiness.className = occupation.value == "Business" ? "optional invalid" : "optional valid";
        inputDesignation.className = occupation.value == "Job" ? "optional invalid" : "optional valid";
        inputCompanyName.className = (occupation.value == "Job" || occupation.value == "Business") ? "optional invalid" : "optional valid";
        inputAnnualIncome.className = (occupation.value == "Job" || occupation.value == "Business") ? "optional invalid" : "optional valid";

        if (occupation.value != "Business") {
            inputAreaOfBusiness.value = "";
        }
        if (occupation.value != "Job") {
            inputDesignation.value = "";
        }
        if (occupation.value != "Business" && occupation.value != "Job") {
            inputCompanyName.value = "";
            inputAnnualIncome.value = "";
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
            
            document.getElementById('permanent_address').className = 'textinput3';
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
            document.getElementById(input).value = "";
            setTimeout(function () {document.getElementById(input).focus();}, 10);
        }
    }

    function validateContactNumber(input) {
        var inputValue = document.getElementById(input).value;
        contactChars = Array.from(inputValue);

        for (i=0 ; i < contactChars.length ; i++) {
            if (isNaN(contactChars[i]) && contactChars[i] != ' ' && contactChars[i] != '-' && contactChars[i] != '+') {
                alert("Invalid value: " + inputValue + ", Please enter valid contact number.");
                document.getElementById(input).value = "";
                setTimeout(function () {document.getElementById(input).focus();}, 10);
                break;
            } 
        }
    }

    
    const fileSelect1 = document.getElementById("AddImage1"),
        fileElem1 = document.getElementById("profile_pic1")
    fileSelect1.addEventListener("click", function(e) {
        if (fileElem1) {
            fileElem1.click();
        }
    }, false);

    const fileSelect2 = document.getElementById("AddImage2"),
        fileElem2 = document.getElementById("profile_pic2")
    fileSelect2.addEventListener("click", function(e) {
        if (fileElem2) {
            fileElem2.click();
        }
    }, false);

    const fileSelect3 = document.getElementById("AddImage3"),
        fileElem3 = document.getElementById("profile_pic3")
    fileSelect3.addEventListener("click", function(e) {
        if (fileElem3) {
            fileElem3.click();
        }
    }, false);

    const fileSelect4 = document.getElementById("AddImage4"),
        fileElem4 = document.getElementById("profile_pic4")
    fileSelect4.addEventListener("click", function(e) {
        if (fileElem4) {
            fileElem4.click();
        }
    }, false);

    mainImageElement = document.getElementById('mainimage');
    removeFilesListInput = document.getElementById("removeFilesList");

    const rmfileSelect1 = document.getElementById("RemoveImage1"),
        rmfileElem1 = document.getElementById("profile_pic1")
    rmfileSelect1.addEventListener("click", function(e) {

        if (rmfileElem1) {
            rmfileElem1.value = "";
            img1 = document.getElementById("image1");
            oldImage1 = img1.src.substr(img1.src.lastIndexOf("/") + 1);
            img1src = img1.src;
            if (mainImageElement.src == img1src.replace("thumbnail", "mainimage")) {
                mainImageElement.src = "/images/blank-profile-picture.png";
            }
            img1.src = "/images/blank-profile-picture.png";
            if (removeFilesListInput.value == "") {
                removeFilesListInput.value = oldImage1;
            } else {
                removeFilesListInput.value = removeFilesListInput.value + "," + oldImage1;
            }
        }

    }, false);

    const rmfileSelect2 = document.getElementById("RemoveImage2"),
        rmfileElem2 = document.getElementById("profile_pic2")
    rmfileSelect2.addEventListener("click", function(e) {


        if (rmfileElem2) {
            rmfileElem2.value = "";
            img2 = document.getElementById("image2");
            oldImage2 = img2.src.substr(img2.src.lastIndexOf("/") + 1);
            img2src = img2.src;
            if (mainImageElement.src == img2src.replace("thumbnail", "mainimage")) {
                mainImageElement.src = "/images/blank-profile-picture.png";
            }
            img2.src = "/images/blank-profile-picture.png";
            if (removeFilesListInput.value == "") {
                removeFilesListInput.value = oldImage2;
            } else {
                removeFilesListInput.value = removeFilesListInput.value + "," + oldImage2;
            }
        }

    }, false);

    const rmfileSelect3 = document.getElementById("RemoveImage3"),
        rmfileElem3 = document.getElementById("profile_pic3")
    rmfileSelect3.addEventListener("click", function(e) {

        if (rmfileElem3) {
            rmfileElem3.value = "";
            img3 = document.getElementById("image3");
            oldImage3 = img3.src.substr(img3.src.lastIndexOf("/") + 1);
            img3src = img3.src;
            if (mainImageElement.src == img3src.replace("thumbnail", "mainimage")) {
                mainImageElement.src = "/images/blank-profile-picture.png";
            }
            img3.src = "/images/blank-profile-picture.png";
            if (removeFilesListInput.value == "") {
                removeFilesListInput.value = oldImage3;
            } else {
                removeFilesListInput.value = removeFilesListInput.value + "," + oldImage3;
            }
        }

    }, false);

    const rmfileSelect4 = document.getElementById("RemoveImage4"),
        rmfileElem4 = document.getElementById("profile_pic4")
    rmfileSelect4.addEventListener("click", function(e) {

        if (rmfileElem4) {
            rmfileElem4.value = "";
            img4 = document.getElementById("image4");
            oldImage4 = img4.src.substr(img4.src.lastIndexOf("/") + 1);
            img4src = img4.src;
            if (mainImageElement.src == img4src.replace("thumbnail", "mainimage")) {
                mainImageElement.src = "/images/blank-profile-picture.png";
            }
            img4.src = "/images/blank-profile-picture.png";
            if (removeFilesListInput.value == "") {
                removeFilesListInput.value = oldImage4;
            } else {
                removeFilesListInput.value = removeFilesListInput.value + "," + oldImage4;
            }
        }

    }, false);

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection
