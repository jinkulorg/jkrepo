@extends('layouts.app')

@section('content')
<form id="profileForm" action="/profile" method="post" enctype="multipart/form-data">
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
                            <div class="basic_3">
                                <h4>About Myself</h4>
                            </div>
                            <hr>
                            <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Appearance</b></div></h3>
                            <div class=" row">
                                <div class="col-sm-5">
                                    <table class="table_working_hours">
                                        <tbody>
                                            <tr class="opened_1">
                                                <td class="day_value" colspan="2">
                                                    <div class="img" id="profileImageDiv">
                                                        <table>
                                                            <tr>
                                                                <td colspan="4">
                                                                    <img id="mainimage" src="/images/blank-profile-picture.png" width="300" height="300">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <img id="image1" src="/images/blank-profile-picture.png" width="73" height="63" onclick="showInMainImage('image1')">&nbsp;
                                                                </td>
                                                                <td>
                                                                    <img id="image2" src="/images/blank-profile-picture.png" width="73" height="63" onclick="showInMainImage('image2')">&nbsp;
                                                                </td>
                                                                <td>
                                                                    <img id="image3" src="/images/blank-profile-picture.png" width="73" height="63" onclick="showInMainImage('image3')">&nbsp;
                                                                </td>
                                                                <td>
                                                                    <img id="image4" src="/images/blank-profile-picture.png" width="73" height="63" onclick="showInMainImage('image4')">&nbsp;
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: center">
                                                                    <label id="AddImage1" class="button_add button4" data-toggle="tooltip" data-placement="bottom" title="Add first image"><i class="fa fa-plus" aria-hidden="true"></i></label>
                                                                    <label id="RemoveImage1" class="button_remove button4" data-toggle="tooltip" data-placement="bottom" title="Remove first image"><i class="fa fa-trash-o" aria-hidden="true"></i></label>
                                                                </td>
                                                                <td style="text-align: center">
                                                                    <label id="AddImage2" class="button_add button4" data-toggle="tooltip" data-placement="bottom"title="Add second image"><i class="fa fa-plus" aria-hidden="true"></i></label>
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
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <ul class="login_details1">
                                        <li>
                                            <label style="color: #c32143; margin: 10px">
                                                Upload square images for best view (e.g, 2611 X 2611). Use croppola to crop images.
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
                                                    <b>AUTO GENERATE</b>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label"><b>Status:</b></td>
                                                <td class="day_value">
                                                    <b>INACTIVE</b>
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
                                                    <input class="optional valid" type="file" name="profile_pic_path1" id="profile_pic1" oninput="this.className = ''" onchange="showImages(1)">
                                                </div>
                                                <div id="divImage2" class="inputText_block1" style="display: none">
                                                    <input class="optional valid" type="file" name="profile_pic_path2" id="profile_pic2" oninput="this.className = ''" onchange="showImages(2)">
                                                </div>
                                                <div id="divImage3" class="inputText_block1" style="display: none">
                                                    <input class="optional valid" type="file" name="profile_pic_path3" id="profile_pic3" oninput="this.className = ''" onchange="showImages(3)">
                                                </div>
                                                <div id="divImage4" class="inputText_block1" style="display: none">
                                                    <input class="optional valid" type="file" name="profile_pic_path4" id="profile_pic4" oninput="this.className = ''" onchange="showImages(4)">
                                                </div>
                                            </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Gender :</td>
                                                <td class="day_value">
                                                    <div class="form_radios">
                                                        <span id="spangenderM">
                                                            <input type="radio" name="gender" id="gender" value="M" onchange="validSpan('spangenderM','spangenderF')"> Male &nbsp;&nbsp;
                                                        </span>
                                                        <span id="spangenderF">
                                                            <input type="radio" name="gender" id="gender" value="F" onchange="validSpan('spangenderM','spangenderF')"> Female
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Physical Status:</td>
                                                <td class="day_value">
                                                    <div class="select-block1">
                                                        <select id="physical_status" name="physical_status" onchange="this.className = ''">
                                                            <option selected disabled hidden value="">--Select Physical Status--</option>
                                                            <option>Normal</option>
                                                            <option>Abnormal</option>
                                                            <option>Handicapped</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Complexion:</td>
                                                <td class="day_value">
                                                    <div class="select-block1">
                                                        <select name="complexion" onchange="this.className = ''">
                                                            <option selected disabled hidden value="">--Select Complexion--</option>
                                                            <option>Very Fair</option>
                                                            <option>Fair</option>
                                                            <option>Dark</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Height:</td>
                                                <td class="day_value">
                                                    <div class="inputText_block1">
                                                        <div class="oneline">
                                                            <input type="text" name="heightfeet" id="heightfeet" oninput="this.className = ''" onblur="validateNumber('heightfeet')"> feet
                                                        </div>
                                                        <div class="oneline">
                                                            <input type="text" name="heightinches" id="heightinches" oninput="this.className = ''" onblur="validateNumber('heightinches')"> Inches
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Weight:</td>
                                                <td class="day_value">
                                                    <div class="inputText_block1" style="width: 120px">
                                                        <input type="text" name="weight" id="weight" oninput="this.className = ''" onblur="validateNumber('weight')"> Kgs
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_label">Specs:</td>
                                                <td class="day_value">
                                                    <div id="divspecs" class="form_radios">
                                                        <span id="spanspecsYes">
                                                            <input type="radio" class="radio_1" name="specs" value="Yes" onchange="validSpan('spanspecsYes','spanspecsNo')"> Yes &nbsp;&nbsp;
                                                        </span>
                                                        <span id="spanspecsNo">
                                                            <input type="radio" class="radio_1" name="specs" value="No" onchange="validSpan('spanspecsYes','spanspecsNo')"> No &nbsp;&nbsp;
                                                        </span>
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
                                            <td>
                                                <div class="container2">
                                                    <div class="comment">
                                                        <textarea class="textinput" cols="130" rows="5" maxlength="250" name="self_description" oninput="this.className = 'textinput'" placeholder="Write here some more about you"></textarea>
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
                                                    <select id="profile_created_by" name="profile_created_by" onchange="ShowHideDivProfileCreatedBy(this)">
                                                        <option selected disabled hidden value="">--Select Relevant--</option>
                                                        <option>Self</option>
                                                        <option>Sibling</option>
                                                        <option>Parent/Guardian</option>
                                                        <option>Others</option>
                                                    </select>
                                                </div>
                                                <div id="divProfileCreatedBy" class="inputText_block1" style="display: none">
                                                    <input class="optional valid" type="text" name="profile_created_by_others" id="profile_created_by_others" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Marital Status:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="marital_status" onchange="this.className = ''">
                                                        <option selected disabled hidden value="">--Select Marital Status--</option>
                                                        <option>Never Married</option>
                                                        <option>Divorced</option>
                                                        <option>Widowed</option>
                                                        <option>Annulled</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Hobby:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="hobby" name="hobby" onchange="showHideDivHobby(this)">
                                                        <option selected disabled hidden value="">--Select Hobby--</option>
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
                                                    <input class="optional valid" type="text" name="hobby_others" maxlength="250" id="hobby_others" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Subcaste:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="subcast" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Native:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="native" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-1" >&nbsp;</div>
                            <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Life Style</b></div></h3>
                            <div class="col-sm-5">
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Drink:</td>
                                            <td class="day_value">
                                                <div id="divdrink" class="form_radios">
                                                    <span id="spandrinkYes">
                                                        <input type="radio" class="radio_1" name="drink" value="Yes" onchange="validSpan('spandrinkYes','spandrinkNo','spandrinkOccasionally')"> Yes &nbsp;&nbsp;
                                                    </span>
                                                    <span id="spandrinkNo">
                                                        <input type="radio" class="radio_1" name="drink" value="No" onchange="validSpan('spandrinkYes','spandrinkNo','spandrinkOccasionally')"> No &nbsp;&nbsp;
                                                    </span>
                                                    <span id="spandrinkOccasionally">
                                                        <input type="radio" class="radio_1" name="drink" value="Occasionally" onchange="validSpan('spandrinkYes','spandrinkNo','spandrinkOccasionally')"> Occasionally
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Smoke:</td>
                                            <td class="day_value">
                                                <div id="divsmoke" class="form_radios">
                                                    <span id="spansmokeYes">
                                                        <input type="radio" class="radio_1" name="smoke" value="Yes" onchange="validSpan('spansmokeYes','spansmokeNo','spansmokeOccasionally')"> Yes &nbsp;&nbsp;
                                                    </span>
                                                    <span id="spansmokeNo">
                                                        <input type="radio" class="radio_1" name="smoke" value="No" onchange="validSpan('spansmokeYes','spansmokeNo','spansmokeOccasionally')"> No &nbsp;&nbsp;
                                                    </span>
                                                    <span id="spansmokeOccasionally">
                                                        <input type="radio" class="radio_1" name="smoke" value="Occasionally" onchange="validSpan('spansmokeYes','spansmokeNo','spansmokeOccasionally')"> Occasionally
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Vegetarian:</td>
                                            <td class="day_value">
                                                <div id="divvegetarian" class="form_radios">
                                                    <span id="spanvegetarianYes">
                                                        <input type="radio" class="radio_1" name="vegetarian" value="Yes" onchange="validSpan('spanvegetarianYes','spanvegetarianNo','spanvegetarianOccasionally')"> Yes &nbsp;&nbsp;
                                                    </span>
                                                    <span id="spanvegetarianNo">
                                                        <input type="radio" class="radio_1" name="vegetarian" value="No" onchange="validSpan('spanvegetarianYes','spanvegetarianNo','spanvegetarianOccasionally')"> No &nbsp;&nbsp;
                                                    </span>
                                                    <span id="spanvegetarianOccasionally">
                                                        <input type="radio" class="radio_1" name="vegetarian" value="Occasionally" onchange="validSpan('spanvegetarianYes','spanvegetarianNo','spanvegetarianOccasionally')"> Occasionally
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Non-Vegetarian:</td>
                                            <td class="day_value">
                                                <div id="divnon_vegetarian" class="form_radios">
                                                    <span id="spannon_vegetarianYes">
                                                        <input type="radio" class="radio_1" name="non_vegetarian" value="Yes" onchange="validSpan('spannon_vegetarianYes','spannon_vegetarianNo','spannon_vegetarianOccasionally')"> Yes &nbsp;&nbsp;
                                                    </span>
                                                    <span id="spannon_vegetarianNo">
                                                        <input type="radio" class="radio_1" name="non_vegetarian" value="No" onchange="validSpan('spannon_vegetarianYes','spannon_vegetarianNo','spannon_vegetarianOccasionally')"> No &nbsp;&nbsp;
                                                    </span>
                                                    <span id="spannon_vegetarianOccasionally">
                                                        <input type="radio" class="radio_1" name="non_vegetarian" value="Occasionally" onchange="validSpan('spannon_vegetarianYes','spannon_vegetarianNo','spannon_vegetarianOccasionally')"> Occasionally
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Eggetarian:</td>
                                            <td class="day_value">
                                                <div id="diveggetarian" class="form_radios">
                                                    <span id="spaneggetarianYes">
                                                        <input type="radio" class="radio_1" name="eggetarian" value="Yes" onchange="validSpan('spaneggetarianYes','spaneggetarianNo','spaneggetarianOccasionally')"> Yes &nbsp;&nbsp;
                                                    </span>
                                                    <span id="spaneggetarianNo">
                                                        <input type="radio" class="radio_1" name="eggetarian" value="No" onchange="validSpan('spaneggetarianYes','spaneggetarianNo','spaneggetarianOccasionally')"> No &nbsp;&nbsp;
                                                    </span>
                                                    <span id="spaneggetarianOccasionally">
                                                        <input type="radio" class="radio_1" name="eggetarian" value="Occasionally" onchange="validSpan('spaneggetarianYes','spaneggetarianNo','spaneggetarianOccasionally')"> Occasionally
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Astro Details</b></div></h3>
                            <div class="col-sm-6">
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Date:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="birth_date" id="datepicker-3" placeholder="Click on calender to select date" onchange="this.className = ''" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Time:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="hour" onchange="this.className = ''">
                                                        <option selected disabled hidden value="">Hours</option>
                                                        <option>01</option>
                                                        <option>02</option>
                                                        <option>03</option>
                                                        <option>04</option>
                                                        <option>05</option>
                                                        <option>06</option>
                                                        <option>07</option>
                                                        <option>08</option>
                                                        <option>09</option>
                                                        <option>10</option>
                                                        <option>11</option>
                                                        <option>12</option>
                                                    </select>
                                                    <select name="minute" onchange="this.className = ''">
                                                        <option selected disabled hidden value="">Minutes</option>
                                                        <option>00</option>
                                                        <option>01</option>
                                                        <option>02</option>
                                                        <option>03</option>
                                                        <option>04</option>
                                                        <option>05</option>
                                                        <option>06</option>
                                                        <option>07</option>
                                                        <option>08</option>
                                                        <option>09</option>
                                                        <option>10</option>
                                                        <option>11</option>
                                                        <option>12</option>
                                                        <option>13</option>
                                                        <option>14</option>
                                                        <option>15</option>
                                                        <option>16</option>
                                                        <option>17</option>
                                                        <option>18</option>
                                                        <option>19</option>
                                                        <option>20</option>
                                                        <option>21</option>
                                                        <option>22</option>
                                                        <option>23</option>
                                                        <option>24</option>
                                                        <option>25</option>
                                                        <option>26</option>
                                                        <option>27</option>
                                                        <option>28</option>
                                                        <option>29</option>
                                                        <option>30</option>
                                                        <option>31</option>
                                                        <option>32</option>
                                                        <option>33</option>
                                                        <option>34</option>
                                                        <option>35</option>
                                                        <option>36</option>
                                                        <option>37</option>
                                                        <option>38</option>
                                                        <option>39</option>
                                                        <option>40</option>
                                                        <option>41</option>
                                                        <option>42</option>
                                                        <option>43</option>
                                                        <option>44</option>
                                                        <option>45</option>
                                                        <option>46</option>
                                                        <option>47</option>
                                                        <option>48</option>
                                                        <option>49</option>
                                                        <option>50</option>
                                                        <option>51</option>
                                                        <option>52</option>
                                                        <option>53</option>
                                                        <option>54</option>
                                                        <option>55</option>
                                                        <option>56</option>
                                                        <option>57</option>
                                                        <option>58</option>
                                                        <option>59</option>
                                                    </select>
                                                    <select name="second" onchange="this.className = ''">
                                                        <option selected disabled hidden value="">Seconds</option>
                                                        <option>00</option>
                                                        <option>01</option>
                                                        <option>02</option>
                                                        <option>03</option>
                                                        <option>04</option>
                                                        <option>05</option>
                                                        <option>06</option>
                                                        <option>07</option>
                                                        <option>08</option>
                                                        <option>09</option>
                                                        <option>10</option>
                                                        <option>11</option>
                                                        <option>12</option>
                                                        <option>13</option>
                                                        <option>14</option>
                                                        <option>15</option>
                                                        <option>16</option>
                                                        <option>17</option>
                                                        <option>18</option>
                                                        <option>19</option>
                                                        <option>20</option>
                                                        <option>21</option>
                                                        <option>22</option>
                                                        <option>23</option>
                                                        <option>24</option>
                                                        <option>25</option>
                                                        <option>26</option>
                                                        <option>27</option>
                                                        <option>28</option>
                                                        <option>29</option>
                                                        <option>30</option>
                                                        <option>31</option>
                                                        <option>32</option>
                                                        <option>33</option>
                                                        <option>34</option>
                                                        <option>35</option>
                                                        <option>36</option>
                                                        <option>37</option>
                                                        <option>38</option>
                                                        <option>39</option>
                                                        <option>40</option>
                                                        <option>41</option>
                                                        <option>42</option>
                                                        <option>43</option>
                                                        <option>44</option>
                                                        <option>45</option>
                                                        <option>46</option>
                                                        <option>47</option>
                                                        <option>48</option>
                                                        <option>49</option>
                                                        <option>50</option>
                                                        <option>51</option>
                                                        <option>52</option>
                                                        <option>53</option>
                                                        <option>54</option>
                                                        <option>55</option>
                                                        <option>56</option>
                                                        <option>57</option>
                                                        <option>58</option>
                                                        <option>59</option>
                                                    </select>
                                                    <select class="last" name="format" onchange="this.className = 'last '">
                                                        <option selected disabled hidden value="">AM/PM</option>
                                                        <option>AM</option>
                                                        <option>PM</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Place:</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="birth_place" oninput="this.className = ''">
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
                                                    <select name="rashi" placeholder="Select Rashi..." onchange="this.className = ''">
                                                        <option selected disabled hidden value="">--Select Rashi--</option>
                                                        <option>Aries or Maish</option>
                                                        <option>Taurus or Vrishabh </option>
                                                        <option>Gemini or Mithun</option>
                                                        <option>Cancer or Kark</option>
                                                        <option>Leo or Sinh</option>
                                                        <option>Vigro or Kanya</option>
                                                        <option>Libra or Tula</option>
                                                        <option>Scorpio or Vruschik</option>
                                                        <option>Sagittarius or Dhan</option>
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
                                                <div id="divmangal" class="form_radios">
                                                    <span id="spanmangal1">
                                                        <input type="radio" class="radio_1" name="mangal" value="1" onchange="validSpan('spanmangal1','spanmangal0')"> Yes &nbsp;&nbsp;
                                                    </span>
                                                    <span id="spanmangal0">
                                                        <input type="radio" class="radio_1" name="mangal" value="0" onchange="validSpan('spanmangal1','spanmangal0')"> No
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Shani:</td>
                                            <td class="day_value">
                                                <div id="divshani" class="form_radios">
                                                    <span id="spanshani1">
                                                        <input type="radio" class="radio_1" name="shani" value="1" onchange="validSpan('spanshani1','spanshani0')"> Yes &nbsp;&nbsp;
                                                    </span>
                                                    <span id="spanshani0">
                                                        <input type="radio" class="radio_1" name="shani" value="0" onchange="validSpan('spanshani1','spanshani0')"> No
                                                    </span>
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
                                                    <select name="education" id="education" onchange="ShowHideDivEducation(this)">
                                                        <option selected disabled hidden value="">--Select Education--</option>
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
                                                <div id="divEducation" class="inputText_block1" style="display: none">
                                                    <input class="optional valid" type="text" name="education_others" id="education_others" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-5">
                                <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Career</b></div></h3>
                                <table class="table_working_hours">
                                    <tbody>
                                        <tr class="opened_1">
                                            <td class="day_label">Occupation :</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="occupation" id="occupation" onchange="showHideDevOccupation(this)">
                                                        <option selected disabled hidden value="">--Select Occupation--</option>
                                                        <option>Job</option>
                                                        <option>Business</option>
                                                        <option>Home Maker</option>
                                                        <option>Not Applicable (Studying)</option>
                                                        <option>Not Applicable (Not Working)</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="opened_1">
                                            <td class="day_label">
                                                <div id="divAreaOfBusinessLabel" style="display: none">
                                                    Area of Bussiness :
                                                </div>
                                            </td>
                                            <td class="day_value">
                                                <div class="inputText_block1" id="divAreaOfBusiness" style="display: none">
                                                    <input class="optional valid" type="text" name="area_of_business" id="area_of_business" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">
                                                <div id="divDesignationLabel" style="display: none">
                                                    Designation :
                                                </div>
                                            </td>
                                            <td class="day_value">
                                                <div class="inputText_block1" id="divDesignation" style="display: none">
                                                    <input class="optional valid" type="text" name="designation" id="designation" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">
                                                <div id="divCompanyNameLabel" style="display: none">
                                                    Company Name :
                                                </div>
                                            </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <div id="divCompanyName" style="display: none">
                                                        <input class="optional valid" type="text" id="company_name" name="company_name" oninput="this.className = ''">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">
                                                <div id="divAnnualIncomeLabel" style="display: none">
                                                    Annual Income :
                                                </div>
                                            </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <div id="divAnnualIncome" style="display: none">
                                                        <input class="optional valid" type="text" name="annual_income" id="annual_income" oninput="this.className = ''" onblur="validateNumber('annual_income')">
                                                    </div>
                                                </div>
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
                                            <td class="day_label">Contact Number: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="contact_no" id="contact_no" oninput="this.className = ''" onblur="validateContactNumber('contact_no')">
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
                                                        <textarea class="textinput3" maxlength="250" name="present_address" id="present_address" oninput="this.className = 'textinput3'"></textarea>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">City :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="present_city" id="present_city" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Taluka :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="present_taluka" id="present_taluka" oninput="this.className = ''">
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
                                            <td class="day_label">District :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="present_district" id="present_district" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">State :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="present_state" id="present_state" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Country :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="present_country" id="present_country" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Pincode :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="present_pincode" id="present_pincode" oninput="this.className = ''">
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
                                <input type="checkbox" name="sameAddress" class="radio_1" id="sameAddress" onclick="sameAddressAction()" /> <b><i> Same as Present Address</i></b> &nbsp;&nbsp;
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table_working_hours">
                                    <tbody>
                                        <!-- <tr class="opened_1">
                                            
                                        </tr> -->
                                        <tr class="opened_1">
                                            <td class="day_label">Address: </td>
                                            <td class="day_value">
                                                <div class="container3">
                                                    <div class="comment3">
                                                        <textarea class="textinput3" maxlength="250" name="permanent_address" id="permanent_address" oninput="this.className = 'textinput3'"></textarea>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">City: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="permanent_city" id="permanent_city" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Taluka: </td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="permanent_taluka" id="permanent_taluka" oninput="this.className = ''">
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
                                            <td class="day_label">District :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="permanent_district" id="permanent_district" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">State :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="permanent_state" id="permanent_state" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Country :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="permanent_country" id="permanent_country" oninput="this.className = ''">
                                                </div>
                                            </td>

                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Pincode :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="permanent_pincode" id="permanent_pincode" oninput="this.className = ''">
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
                                        <br>
                                        <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Father's Details</b></div></h3>
                                        <tr class="opened_1">
                                            <td class="day_label">Father's Name :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="father_name" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Father's Occupation :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="father_occupation" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Father's Annual Income :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input class="optional valid" type="text" name="father_annual_income" id="father_annual_income" oninput="this.className = ''" onblur="validateNumber('father_annual_income')">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Father's Contact Number :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="father_contact_no" id="father_contact_no" oninput="this.className = ''" onblur="validateContactNumber('father_contact_no')">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-1" ></div>
                            <div class="col-sm-5">
                                <table class="table_working_hours">
                                    <tbody>
                                        <br>
                                        <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Mother' Details</b></div></h3>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Name :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="mother_name" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Occupation :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="mother_occupation" oninput="this.className = ''">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Annual Income :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input class="optional valid" type="text" name="mother_annual_income" id="mother_annual_income" oninput="this.className = ''" onblur="validateNumber('mother_annual_income')">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Mother's Contact Number :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="mother_contact_no" id="mother_contact_no" oninput="this.className = ''" onblur="validateContactNumber('mother_contact_no')">
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
                                        <h3 class="profile_title"><div style="margin: 5px; padding: 5px;"><b>Brothers & Sisters</b></div></h3>
                                        <tr class="opened_1">
                                            <td class="day_label">Number of Brothers: </td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="no_of_brothers" name="no_of_brothers" onchange="this.className = ''">
                                                        <option selected disabled hidden value="">--Select No. of Brothers--</option>
                                                        <option>None</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>More than 5</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Number of Sisters: </td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="no_of_sisters" name="no_of_sisters" onchange="this.className = ''">
                                                        <option selected disabled hidden value="">--Select No. of Sisters--</option>
                                                        <option>None</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>More than 5</option>
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
                    <h3><i class="fa fa-spinner fa-pulse fa-1x fa-fw" aria-hidden="true"></i> Creating profile</h3>
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
<script type="text/javascript">

    function showImages(identity) {
        var fileInput = document.getElementById('profile_pic' + identity);
        makeAllFileInputValid();
        var files = fileInput.files;
        for (i = 0; i < files.length; i++) {
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
        mainImageElement.src = imageFrom.src;
    }

    function ShowHideDivProfileCreatedBy(obj) {
        obj.className = '';
        var profile_created_by = document.getElementById("profile_created_by");
        var divProfileCreatedBy = document.getElementById("divProfileCreatedBy");
        divProfileCreatedBy.style.display = profile_created_by.value == "Others" ? "block" : "none";
        var inputProfileCreatedByOthers = document.getElementById("profile_created_by_others");
        inputProfileCreatedByOthers.className = profile_created_by.value == "Others" ? "optional invalid" : "optional valid";
        if (profile_created_by.value != "Others") {
            inputProfileCreatedByOthers.value = "";
        }
    }

    function ShowHideDivEducation(obj) {
        obj.className = '';
        var education = document.getElementById("education");
        var divEducation = document.getElementById("divEducation");
        divEducation.style.display = education.value == "Others" ? "block" : "none";
        var inputEducation = document.getElementById("education_others");
        inputEducation.className = education.value == "Others" ? "optional invalid" : "optional valid";
        if (education.value != "Others") {
            inputEducation.value = "";
        }
    }

    function showHideDivHobby(obj) {
        obj.className = '';
        var hobby = document.getElementById("hobby");
        var divHobby = document.getElementById("divHobby");
        divHobby.style.display = hobby.value == "Others" ? "block" : "none";
        var inputHobby = document.getElementById("hobby_others");
        inputHobby.className = hobby.value == "Others" ? "optional invalid" : "optional valid";
        if (hobby.value != "Others") {
            inputHobby.value = "";
        }
    }

    function showHideDevOccupation(obj) {
        obj.className = '';
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

        // Validation logic
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

            document.getElementById('permanent_address').readOnly = true;
            document.getElementById('permanent_city').readOnly = true;
            document.getElementById('permanent_taluka').readOnly = true;
            document.getElementById('permanent_district').readOnly = true;
            document.getElementById('permanent_state').readOnly = true;
            document.getElementById('permanent_country').readOnly = true;
            document.getElementById('permanent_pincode').readOnly = true;

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

            document.getElementById('permanent_address').readOnly = false;
            document.getElementById('permanent_city').readOnly = false;
            document.getElementById('permanent_taluka').readOnly = false;
            document.getElementById('permanent_district').readOnly = false;
            document.getElementById('permanent_state').readOnly = false;
            document.getElementById('permanent_country').readOnly = false;
            document.getElementById('permanent_pincode').readOnly = false;
        }
    }

    function validSpan(spanid1, spanid2) {
        var span = document.getElementById(spanid1);
        span.className = "";
        span = document.getElementById(spanid2);
        span.className = "";
    }

    function validSpan(spanid1, spanid2, spanid3) {
        var span = document.getElementById(spanid1);
        span.className = "";
        span = document.getElementById(spanid2);
        span.className = "";
        span = document.getElementById(spanid3);
        span.className = "";
    }

    function validateNumber(input) {
        var inputValue = document.getElementById(input).value;
        if (isNaN(inputValue)) {
            alert("Invalid value: " + inputValue + ", Please enter numeric value.");
            document.getElementById(input).value = "";
            setTimeout(function() {
                document.getElementById(input).focus();
            }, 10);
        }
    }

    function validateContactNumber(input) {
        var inputValue = document.getElementById(input).value;
        contactChars = Array.from(inputValue);

        for (i = 0; i < contactChars.length; i++) {
            if (isNaN(contactChars[i]) && contactChars[i] != ' ' && contactChars[i] != '-' && contactChars[i] != '+') {
                alert("Invalid value: " + inputValue + ", Please enter valid contact number.");
                document.getElementById(input).value = "";
                setTimeout(function() {
                    document.getElementById(input).focus();
                }, 10);
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
            if (mainImageElement.src == img1.src) {
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
            if (mainImageElement.src == img2.src) {
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
            if (mainImageElement.src == img3.src) {
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
            if (mainImageElement.src == img4.src) {
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