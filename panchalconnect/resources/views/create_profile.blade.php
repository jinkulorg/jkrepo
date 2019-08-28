@extends('layouts.app')

@section('content')
<form id="profileForm" action="/profile" method="post">
    @csrf
    <div class="grid_3">
        <div class="container">
            <div class="breadcrumb1">
                <ul>
                    <a href="/"><i class="fa fa-home home_1"></i></a>
                    <span class="divider">&nbsp;| &nbsp;</span>
                    <li class="current-page">
                        <h4>Create Profile </h4>
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
                                                    <input type="file" name="profile_pic_path">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">First Name :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="name">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Last Name :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="lastname">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Gender :</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="gender" name="gender">
                                                        <option value=""> --Select Gender--</option>
                                                        <option value="M"> Male </option>
                                                        <option value="F"> Female </option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="opened_1">
                                            <td class="day_label">Physical Status:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="physical_status">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Height:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">    
                                                <input type="text" name="height">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Weight:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">    
                                                <input type="text" name="weight">
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
                                                <input type="text" name="hobby">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Complexion:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="complexion">
                                                        <option value=""> --Select Complexion-- </option>
                                                        <option> Fair </option>
                                                        <option> Wheatish </option>
                                                        <option> Medium Brown </option>
                                                        <option> Brown </option>
                                                        <option> Dark Brown </option>
                                                        <option> Intense Dark</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Specs:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="specs">
                                                        <option> --Select YES/NO--</option>
                                                        <option> YES </option>
                                                        <option> NO </option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Vegetarion:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="vegetarion">
                                                        <option> --Select YES/NO--</option>
                                                        <option> YES </option>
                                                        <option> NO </option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Non-Vegetarion:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="non_vegetarion">
                                                        <option> --Select YES/NO--</option>
                                                        <option> YES </option>
                                                        <option> NO </option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Eggetarion:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="eggetarion">
                                                        <option> --Select YES/NO--</option>
                                                        <option> YES </option>
                                                        <option> NO </option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Drink:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="drink">
                                                        <option> --Select YES/NO--</option>
                                                        <option> YES </option>
                                                        <option> NO </option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Smoke:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="smoke">
                                                        <option> --Select YES/NO--</option>
                                                        <option> YES </option>
                                                        <option> NO </option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Self Descripation:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="self_description">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Profile Created By:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="profile_created_by">
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
                                                <input type="text" name="subcast">
                                            </div>
                                            </td>

                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Date:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="birth_date">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Time:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="birth_time">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Place:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="birth_place">
                                            </div>
                                            </td>
                                        </tr>

                                        <tr class="opened_1">
                                            <td class="day_label">Native:</td>
                                            <td class="day_value"> 
                                            <div class = "inputText_block1">
                                                <input type="text" name="native">
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
                                                    <select name="marital_status">
                                                        <option value=""> --Select Marital Status-- </option>
                                                        <option> Single </option>
                                                        <option> Divorce</option>
                                                        <option> </option>

                                                    </select>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Rashi:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="rashi" placeholder="Select Rashi...">
                                                        <option value=""> --Select Rashi-- </option>
                                                        <option>Aries or Maish</option>
                                                        <option>Taurus or Vrish </option>
                                                        <option>Gemini or Mithun</option>
                                                        <option>Cancer or Kark</option>
                                                        <option>Leo or Singh</option>
                                                        <option>Leo or Singh</option>
                                                        <option> Libra or Tula</option>
                                                        <option>Scorpio or Vrishchik</option>
                                                        <option>Scorpio or Vrishchik</option>
                                                        <option>Capricorn or Makar</option>
                                                        <option>Aquarius or Kumbh</option>
                                                        <option>Pisces or Meen</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mangal:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="mangal" placeholder="Select YES/NO">
                                                        <option> --Select YES/NO--</option>
                                                        <option> YES </option>
                                                        <option> NO </option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Shani:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="shani">
                                                        <option> --Select YES/NO--</option>
                                                        <option> YES </option>
                                                        <option> NO </option>
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
                                            <div class = "inputText_block1">
                                                <input type="text" name="highest_education">
                                            </div>
                                        </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Education Details :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="education_details">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Ocuupation :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="occupation">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Area of Bussiness :</td>
                                            <td class="day_value">
                                            <div class = "inputTextarea">
                                                <textarea name="occupation"> </textarea>
                                            </div>
                                            </td>
                                        </tr>

                                        <tr class="opened_1">
                                            <td class="day_label">Designation :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="designation">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Company Name :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="company_name">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Annual Income :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="annual_income">
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
                                                <input type="text" name="email">
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Contact Number :</td>
                                            <td class="day_value">
                                                <input type="text" name="contact_no">
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
                                            <td class="day_value"><textarea name="present_address"></textarea></td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present City :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_city">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present Taluka :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_taluka">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present District :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_district">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present State :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_state">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present Country :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_country">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Present Pincode :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="present_pincode">
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
                                            <td class="day_value"><textarea name="permanent_address"></textarea></td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent City :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_city">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent Taluka :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_taluka">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent District :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_district">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent State :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">    
                                                <input type="text" name="permanent_state">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent Country :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanentcountry">
                                            </div>
                                            </td>

                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Permanent Pincode :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="permanent_pincode">
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
                                                    <input type="text" name="father_name">
                                                </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Father's Ocuupation :</td>
                                                <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <input type="text" name="father_occupation">
                                                </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Father's Annual Income :</td>
                                                <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <input type="text" name="father_annual_income">
                                                </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Father's Contact Number :</td>
                                                <td class="day_value">
                                                <div class = "inputText_block1">
                                                    <input type="text" name="father_contact_no">
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
                                                <input type="text" name="mother_name">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Ocuupation :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="mother_occupation">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Annual Income :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="mother_annual_income">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Contact Number :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="mother_contact_no">
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
                                                        <option value="">--Select Number of Brothers--</option>
                                                        <option> 0 </option>
                                                        <option> 1 </option>
                                                        <option> 2 </option>
                                                        <option> 3 </option>
                                                        <option> 4 </option>
                                                        <option> 5 </option>
                                                        <option> 6 </option>
                                                        <option> 7 </option>
                                                        <option> 8 </option>
                                                        <option> 9 </option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">No. Of Sisters :</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="no_of_sisters" name="no_of_sisters">
                                                        <option value="">--Select Number of Sisters--</option>
                                                        <option> 0 </option>
                                                        <option> 1 </option>
                                                        <option> 2 </option>
                                                        <option> 3 </option>
                                                        <option> 4 </option>
                                                        <option> 5 </option>
                                                        <option> 6 </option>
                                                        <option> 7 </option>
                                                        <option> 8 </option>
                                                        <option> 9 </option>
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
<script src="js/multiform.js"></script>
@endsection