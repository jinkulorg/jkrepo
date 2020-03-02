@extends('layouts.app')

@section('content')
<div class="grid_3">
  <div class="container">
    <div class="breadcrumb1">
      <ul>
        <a href="/"><i class="fa fa-home home_1"></i></a>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page">Advanced Search</li>
      </ul>
    </div>
    <!--<script type="text/javascript">
    $(function () {
     $('#btnRadio').click(function () {
          var checkedradio = $('[name="gr"]:radio:checked').val();
          $("#sel").html("Selected Value: " + checkedradio);
      });
    });
   </script>-->
    <div class="col-md-9 search_left">
      <form method="get" action="/advanced_search">
        @csrf
        <div class="form_but1">
          <label class="col-sm-5 control-lable1">Gender : </label>
          <div class="col-sm-7 form_radios">
            <input type="radio" class="radio_1" name="gender" value="M"> Male &nbsp;&nbsp;
            <input type="radio" class="radio_1" name="gender" value="F" checked="checked"> Female

            <!--<hr />
		<p id="sel"></p><br />
		<input id="btnRadio" type="button" value="Get Selected Value" />-->
          </div>
          <div class="clearfix"> </div>
        </div>
        <div class="form_but1">
          <label class="col-sm-5 control-lable1">Marital Status : </label>
          <div class="col-sm-7 form_radios">
            <input type="checkbox" name="never_married" class="radio_1" value="Never Married" checked="checked" /> Never Married &nbsp;&nbsp;
            <input type="checkbox" name="divorced" class="radio_1" value="Divorced" /> Divorced &nbsp;&nbsp;
            <input type="checkbox" name="widowed" class="radio_1" value="Widowed" /> Widowed &nbsp;&nbsp;
            <br>
            <input type="checkbox" name="annulled" class="radio_1" value="Annulled" /> Annulled &nbsp;&nbsp;
            <input type="checkbox" name="any" class="radio_1" value="" /> Any
          </div>
          <div class="clearfix"> </div>
        </div>
        <div class="form_but1">
          <label class="col-sm-5 control-lable1">Located In : </label>
          <div class="col-sm-7">
            <div class="select-block1">
              <select name="present_state">
                <option value="">--Select Location--</option>
                <?php
                foreach ($allStates as $allstate) {
                  ?>
                  <option value="{{$allstate->present_state}}">{{$allstate->present_country}} - {{$allstate->present_state}}</option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="clearfix"> </div>
        </div>
        <div class="form_but1">
          <label class="col-sm-5 control-lable1">Age : </label>
          <div class="col-sm-7">
            <div class="col-sm-2">
              From
            </div>
            <div class="col-sm-2">
              <input class="form-control has-dark-background" name="ageGreaterThan" id="ageGreaterThan" placeholder="18" value="18" type="text" onblur="validateNumber('ageGreaterThan')">
            </div>
            <div class="col-sm-1">
              To
            </div>
            <div class="col-sm-2">
              <input class="form-control has-dark-background" name="ageLessThan" id="ageLessThan" placeholder="40" value="40" type="text" onblur="validateNumber('ageLessThan')">
            </div>
            <div class="clearfix"> </div>
          </div>
          <div class="clearfix"> </div>
        </div>
        <div class="form_but1">
          <label class="col-sm-5 control-lable1">Interested In : </label>
          <div class="col-sm-7">
            <div class="select-block1">
              <select name="hobby">
                <option value="">--Select Interest--</option>
                <?php
                foreach ($allHobbies as $allhobby) {
                  ?>
                  <option value="{{$allhobby->hobby}}">{{$allhobby->hobby}}</option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="clearfix"> </div>
        </div>
        <div class="form_but1">
          <label class="col-sm-5 control-lable1">Shani/Mangal : </label>
          <div class="col-sm-7 form_radios">
            <input type="checkbox" name="shani" class="radio_1" value="shani" /> Shani &nbsp;&nbsp;
            <input type="checkbox" name="mangal" class="radio_1" value="mangal" /> Mangal &nbsp;&nbsp;
            <input type="checkbox" name="noshanimangal" class="radio_1" value="noshanimangal" /> No shani-Mangal &nbsp;&nbsp;
          </div>
          <div class="clearfix"> </div>
        </div>
        <div class="form_but1">
          <label class="col-sm-5 control-lable1">Education : </label>
          <div class="col-sm-7">
            <div class="select-block1">
              <select name="education">
                <option value="">--Select Education--</option>
                <?php
                foreach ($educations as $education) {
                  ?>
                  <option value="{{$education->education}}">{{$education->education}}</option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="clearfix"> </div>
        </div>

        <div class="form_but1">
          <label class="col-sm-5 control-lable1">Occupation : </label>
          <div class="col-sm-7">
            <div class="select-block1">
              <select name="occupation">
                <option value="">--Select Occupation--</option>
                <?php
                foreach ($occupations as $occupation) {
                  ?>
                  <option value="{{$occupation->occupation}}">{{$occupation->occupation}}</option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="clearfix"> </div>
        </div>

        <div class="form_but1">
          <label class="col-sm-5 control-lable1">Designation : </label>
          <div class="col-sm-7">
            <div class="select-block1">
              <select name="designation">
                <option value="">--Select Designation--</option>
                <?php
                foreach ($designations as $designation) {
                  ?>
                  <option value="{{$designation->designation}}">{{$designation->designation}}</option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="clearfix"> </div>
        </div>

        <div class="form_but1">
          <label class="col-sm-5 control-lable1">Annual Income : </label>
          <!-- <div class="col-sm-7"> -->
          <div class="col-sm-3">
            <div class="select-block2">
              <select id="sign" name="sign" onchange="ShowHideDiv()">
                <option value="">--Select Condition--</option>
                <option value="=">Equals (=)</option>
                <option value=">">Greater Than (>)</option>
                <option value="<">Less Than (<)</option> 
                <option value="Range">Range</option>
              </select>
            </div>
          </div>
          <div class="col-sm-2">
            <input type="text" id="amountfrom" name="amountfrom" class="form-control" placeholder="Amount" value="" onblur="validateNumber('amountfrom')"/>
          </div>
          <div id="divamountto" class="col-sm-2" style="display: none">
            <input type="text" id="amountto" name="amountto" class="form-control" placeholder="To" value="" onblur="validateNumber('amountto')" />
          </div>
          <!-- </div> -->
          <div class="clearfix"> </div>
          <div class="clearfix"> </div>
        </div>

        <!-- <div class="form_but1">
          <label class="col-sm-5 control-lable1">Don't Show : </label>
          <div class="col-sm-7">
            <input type="checkbox" class="radio_1" /> Ignored Profiles &nbsp;&nbsp;
            <input type="checkbox" class="radio_1" checked="checked" /> Profiles already Contacted
          </div>
          <div class="clearfix"> </div>
        </div> -->

        <div class="form_but1">
          <label class="col-sm-5 control-lable1"> </label>
          <div class="col-sm-7">
            <br>
            <input class="btn_2" id="submit" type="submit" value="Find Matches">
          </div>
          <div class="clearfix"> </div>
        </div>

      </form>

    </div>
    <div class="col-md-3 match_right">
      <div class="profile_search1">
        <form method="post" id="profile_search_form" onsubmit="setAction()">
          @CSRF
          <input type="hidden" name="_method" value="GET" />
          Search By Id: <input type="text" class="m_1" name="profileid" size="30" placeholder="Enter Profile ID" required>
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
    <div class="clearfix"> </div>
  </div>
</div>

<script type="text/javascript">
  function setAction() {
    var your_form = document.getElementById('profile_search_form');
    your_form.action = "/profile/" + document.getElementsByName("profileid")[0].value;
  }

  function ShowHideDiv() {
    var sign = document.getElementById("sign");
    var divamountto = document.getElementById("divamountto");
    var amountFrom = document.getElementById("amountfrom");
    divamountto.style.display = sign.value == "Range" ? "block" : "none";
    amountFrom.placeholder = sign.value == "Range" ? "From" : "Amount";
  }
  function validateNumber(input) {
        var inputValue = document.getElementById(input).value;
        if (isNaN(inputValue)) {
            alert("Invalid value: " + inputValue + ", Please enter numeric value.");
            setTimeout(function () {document.getElementById(input).focus();}, 10);
        }
    }
</script>
@endsection