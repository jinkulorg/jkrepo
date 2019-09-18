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
  <form>	
   <div class="form_but1">
	<label class="col-sm-5 control-lable1" for="sex">Gender : </label>
	<div class="col-sm-7 form_radios">
		<input type="radio" class="radio_1" /> Male &nbsp;&nbsp;
		<input type="radio" class="radio_1" checked="checked" /> Female
		
		<!--<hr />
		<p id="sel"></p><br />
		<input id="btnRadio" type="button" value="Get Selected Value" />-->
	</div>
	<div class="clearfix"> </div>
  </div>
  <div class="form_but1">
	<label class="col-sm-5 control-lable1" for="sex">Marital Status : </label>
	<div class="col-sm-7 form_radios">
		<input type="checkbox" class="radio_1" /> Single &nbsp;&nbsp;
		<input type="checkbox" class="radio_1" checked="checked" /> Divorced &nbsp;&nbsp;
		<input type="checkbox" class="radio_1" value="Cheese" /> Widowed &nbsp;&nbsp;
		<input type="checkbox" class="radio_1" value="Cheese" /> Separated &nbsp;&nbsp;
		<input type="checkbox" class="radio_1" value="Cheese" /> Any
	</div>
	<div class="clearfix"> </div>
  </div>
  <div class="form_but1">
    <label class="col-sm-5 control-lable1" for="sex">Country : </label>
    <div class="col-sm-7 form_radios">
      <div class="select-block1">
        <select>
            <option value="">Country</option>
            <option value="">Japan</option>
            <option value="">Kenya</option>
            <option value="">Dubai</option>
            <option value="">Italy</option>
            <option value="">Greece</option> 
            <option value="">Iceland</option> 
            <option value="">China</option> 
            <option value="">Doha</option> 
            <option value="">Irland</option> 
            <option value="">Srilanka</option> 
            <option value="">Russia</option> 
            <option value="">Hong Kong</option> 
            <option value="">Germany</option>
            <option value="">Canada</option>  
            <option value="">Mexico</option> 
            <option value="">Nepal</option>
            <option value="">Norway</option> 
            <option value="">Oman</option>
            <option value="">Pakistan</option>  
            <option value="">Kuwait</option> 
            <option value="">Indonesia</option>  
            <option value="">Spain</option>
            <option value="">Thailand</option>  
            <option value="">Saudi Arabia</option> 
            <option value="">Poland</option> 
        </select>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <div class="form_but1">
    <label class="col-sm-5 control-lable1" for="sex">District / City : </label>
    <div class="col-sm-7 form_radios">
      <div class="select-block1">
        <select>
            <option value="">District / City</option>
            <option value="">Japan</option>
            <option value="">Kenya</option>
            <option value="">Dubai</option>
            <option value="">Italy</option>
            <option value="">Greece</option> 
            <option value="">Iceland</option> 
            <option value="">China</option> 
            <option value="">Doha</option> 
            <option value="">Irland</option> 
            <option value="">Srilanka</option> 
            <option value="">Russia</option> 
            <option value="">Hong Kong</option> 
            <option value="">Germany</option>
            <option value="">Canada</option>  
            <option value="">Mexico</option> 
            <option value="">Nepal</option>
            <option value="">Norway</option> 
            <option value="">Oman</option>
            <option value="">Pakistan</option>  
            <option value="">Kuwait</option> 
            <option value="">Indonesia</option>  
            <option value="">Spain</option>
            <option value="">Thailand</option>  
            <option value="">Saudi Arabia</option> 
            <option value="">Poland</option> 
        </select>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <div class="form_but1">
    <label class="col-sm-5 control-lable1" for="sex">State : </label>
    <div class="col-sm-7 form_radios">
      <div class="select-block1">
        <select>
            <option value="">State</option>
            <option value="">Japan</option>
            <option value="">Kenya</option>
            <option value="">Dubai</option>
            <option value="">Italy</option>
            <option value="">Greece</option> 
            <option value="">Iceland</option> 
            <option value="">China</option> 
            <option value="">Doha</option> 
            <option value="">Irland</option> 
            <option value="">Srilanka</option> 
            <option value="">Russia</option> 
            <option value="">Hong Kong</option> 
            <option value="">Germany</option>
            <option value="">Canada</option>  
            <option value="">Mexico</option> 
            <option value="">Nepal</option>
            <option value="">Norway</option> 
            <option value="">Oman</option>
            <option value="">Pakistan</option>  
            <option value="">Kuwait</option> 
            <option value="">Indonesia</option>  
            <option value="">Spain</option>
            <option value="">Thailand</option>  
            <option value="">Saudi Arabia</option> 
            <option value="">Poland</option> 
        </select>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <div class="form_but1">
    <label class="col-sm-5 control-lable1" for="sex">Religion : </label>
    <div class="col-sm-7 form_radios">
      <div class="select-block1">
        <select>
            <option value="">Hindu</option>
            <option value="">Sikh</option>
            <option value="">Jain-All</option>
            <option value="">Jain-Digambar</option>
            <option value="">Jain-Others</option>
            <option value="">Muslim-All</option> 
            <option value="">Muslim-Shia</option> 
            <option value="">Muslim-Sunni</option> 
            <option value="">Muslim-Others</option> 
            <option value="">Christian-All</option> 
            <option value="">Christian-Catholic</option> 
            <option value="">Jewish</option> 
            <option value="">Inter-Religion</option> 
        </select>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <div class="form_but1">
    <label class="col-sm-5 control-lable1" for="sex">Mother Tongue : </label>
    <div class="col-sm-7 form_radios">
      <div class="select-block1">
        <select>
            <option value="">English</option>
            <option value="">French</option>
            <option value="">Telugu</option>
            <option value="">Bengali</option>
            <option value="">Bihari</option>
            <option value="">Hindi</option> 
            <option value="">Koshali</option> 
            <option value="">Khasi</option> 
            <option value="">Tamil</option> 
            <option value="">Urdu</option> 
            <option value="">Manipuri</option> 
        </select>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <div class="form_but1">
	<label class="col-sm-5 control-lable1" for="sex">Show Profile : </label>
	<div class="col-sm-7 form_radios">
		<input type="checkbox" class="radio_1" /> with Photo &nbsp;&nbsp;
		<input type="checkbox" class="radio_1" checked="checked" /> with Horoscope
	</div>
	<div class="clearfix"> </div>
  </div>
  <div class="form_but1">
	<label class="col-sm-5 control-lable1" for="sex">Don't Show : </label>
	<div class="col-sm-7 form_radios">
		<input type="checkbox" class="radio_1" /> Ignored Profiles &nbsp;&nbsp;
		<input type="checkbox" class="radio_1" checked="checked" /> Profiles already Contacted
	</div>
	<div class="clearfix"> </div>
  </div>
  <div class="form_but1">
	<label class="col-sm-5 control-lable1" for="sex">Age : </label>
	<div class="col-sm-7 form_radios">
	  <div class="col-sm-5 input-group1">
        <input class="form-control has-dark-background" name="28" id="slider-name" placeholder="28" type="text" required="">
      </div>
      <div class="col-sm-5 input-group1">
        <input class="form-control has-dark-background" name="40" id="slider-name" placeholder="40" type="text" required="">
      </div>
      <div class="clearfix"> </div>
	</div>
	<div class="clearfix"> </div>
  </div>
 </form>
 
</div>
<div class="col-md-3 match_right">
	<div class="profile_search1">
	   <form method="post" id="profile_search_form" onsubmit="setAction()">
     @CSRF
     <input type="hidden" name="_method" value="GET"/>
		  Search By Id: <input type="text" class="m_1" name="profileid" size="30" placeholder="Enter Profile ID">
		  <input type="submit" value="Go">
	   </form>
   </div>
   <section class="slider">
	 
	 </section>
   <div class="view_profile view_profile2">
        	<h3>Recently Viewed Profiles</h3>

       </div>
     </div>
     <div class="clearfix"> </div>
  </div>
</div>

<script>
function setAction(){
    var your_form = document.getElementById('profile_search_form');
    your_form.action = "/profile/" + document.getElementsByName("profileid")[0].value ;
}
</script>
@endsection