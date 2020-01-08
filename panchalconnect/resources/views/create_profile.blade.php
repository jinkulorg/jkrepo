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
                                        
                                        <tr class="opened_1">
                                            <td class="day_label">First Name :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="name" value = "{{Auth::user()->name}}" disabled>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Last Name :</td>
                                            <td class="day_value">
                                                <div class="inputText_block1">
                                                    <input type="text" name="lastname" value = "{{Auth::user()->lastname}}" disabled>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Gender :</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="gender" name="gender">
                                                        <option selected disabled hidden value="">--Select Gender--</option>
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
                                                        <option selected disabled hidden value="">--Select Complexion--</option>
                                                        <option>Very Fair</option>
                                                        <option>Fair</option>
                                                        <option>Dark</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Specs:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="specs">
                                                        <option selected disabled hidden>--Select YES/NO--</option>
                                                        <option>YES</option>
                                                        <option>NO</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Vegetarion:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="vegetarion">
                                                        <option selected disabled hidden>--Select YES/NO--</option>
                                                        <option>YES</option>
                                                        <option>NO</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Non-Vegetarion:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="non_vegetarion">
                                                        <option selected disabled hidden>--Select YES/NO--</option>
                                                        <option>YES</option>
                                                        <option>NO</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Eggetarion:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="eggetarion">
                                                        <option selected disabled hidden>--Select YES/NO--</option>
                                                        <option>YES</option>
                                                        <option>NO</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Drink:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="drink">
                                                        <option selected disabled hidden>--Select YES/NO--</option>
                                                        <option>YES</option>
                                                        <option>NO</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Smoke:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="smoke">
                                                        <option selected disabled hidden>--Select YES/NO--</option>
                                                        <option>YES</option>
                                                        <option>NO</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Describe Yourself:</td>
                                            <td class="day_value">
                                                <textarea name="self_description"></textarea>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Profile Created By:</td>
                                            <td class="day_value">
                                            <div class="select-block1">
                                                <select name="profile_created_by">
                                                    <option selected disabled hidden>--Select Relevant--</option>
                                                    <option>Self</option>
                                                    <option>Sibling</option>
                                                    <option>Parent/Guadian</option>
                                                    <option>Others</option>
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
                                                <input type="text" name="subcast">
                                            </div>
                                            </td>

                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Date:</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="birth_date" id = "datepicker-3" placeholder="Select Date...">
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Birth Time:</td>
                                            <td class="day_value">
                                            <div class = "select-block1timepicker">
                                                <select name = "hour" > 
                                                        <option selected hidden value = "12">HH</option>
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
                                                    </select> :
                                                    <select name = "minute" > 
                                                        <option selected hidden value = "00">MM</option>
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
                                                    </select> :
                                                    <select name = "second" > 
                                                        <option selected hidden value = "00">SS</option>
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
                                                    <select name ="format">
                                                        <option>AM</option>
                                                        <option>PM</option>
                                                    </select>
                                                    
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
                                            <td class="day_label">Rashi:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="rashi" placeholder="Select Rashi...">
                                                        <option selected disabled hidden value="">--Select Rashi--</option>
                                                        <option>Aries or Maish</option>
                                                        <option>Taurus or Vrish </option>
                                                        <option>Gemini or Mithun</option>
                                                        <option>Cancer or Kark</option>
                                                        <option>Leo or Singh</option>
                                                        <option>Leo or Singh</option>
                                                        <option>Libra or Tula</option>
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
                                                        <option selected disabled hidden>--Select YES/NO--</option>
                                                        <option>YES</option>
                                                        <option>NO</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Shani:</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select name="shani">
                                                        <option selected disabled hidden>--Select YES/NO--</option>
                                                        <option>YES</option>
                                                        <option>NO</option>
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
                                                <select name = "highest_education">
                                                    <option selected disabled hidden>--Select Highest Education--</option>
                                                    <option>Below SSC</option>
                                                    <option>SSC</option>
                                                    <option>HSC</option>
                                                    <option>Bachelor</option>
                                                    <option>Master</option>
                                                    <option>Ph.D</option>
                                                </select>
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
                                            <td class="day_label">Occupation :</td>
                                            <td class="day_value">
                                            <div class="select-block1">
                                                <select name = "occupation">
                                                    <option selected disabled hidden>--Select Occupation--</option>
                                                    <option>Job</option>
                                                    <option>Business</option>
                                                </select>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">Area of Bussiness :</td>
                                            <td class="day_value">
                                            <div class = "inputText_block1">
                                                <input type="text" name="area_of_business">
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
                                                <input type="text" name="email" value = "{{Auth::user()->email}}" disabled>
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
                                                        <option selected disabled hidden value="">--Select Number of Brothers--</option>
                                                        <option>0</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="opened_1">
                                            <td class="day_label">No. Of Sisters :</td>
                                            <td class="day_value">
                                                <div class="select-block1">
                                                    <select id="no_of_sisters" name="no_of_sisters">
                                                        <option selected disabled hidden value="">--Select Number of Sisters--</option>
                                                        <option>0</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
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
<script type="text/javascript">

function showImages() {
    var fileInput = document.getElementById('profile_pic');
    var files = fileInput.files;
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