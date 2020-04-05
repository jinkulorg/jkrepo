@extends('layouts.adminapp')

@section('content')
<div class="container">
  <br>
  <div class="breadcrumb1">
    <ul>
      <a href="/admin"><i class="fa fa-home home_1"></i></a>
      <span class="divider">&nbsp;|&nbsp;</span>
      <li class="current-page">Admin Dashboard</li>
    </ul>
  </div>
  @if(\Session::has('failure'))
    <div class="alert alert-danger">
        <p>{{\Session::get('failure')}}</p>
    </div>
    @endif
    <div style="width: 60%; margin-left:auto; margin-right:auto;">
  <div class="basic_3">
    <h4 style="text-align: center"><b>Panchal Connect Search</b> </h4>
  </div>
  <div class="basic_1">
    <h3 class="profile_title" style="margin: 5px; padding: 5px;"><b>Basic Search</b> </h3>
  </div>
  <form method="get" action="/admin/getuserFromName">
  @csrf
    <div class="form-group">
      <div class="oneline">
        <input style="margin-left: 10px; width: 200px" class="form-control" type="text" name="name" placeholder="Enter Name" required />
      </div>
      <div class="oneline">
        <input style="margin-left: 150px" class="btn_1" type="submit" class="btn btn-primary" value="Search"/>
      </div>
    </div>
  </form>
  <form method="get" action="/admin/getuserFromEmail">
  @csrf
    <div class="form-group">
      <div class="oneline">
        <input style="margin-left: 10px; width: 200px" class="form-control" type="text" name="emailid" placeholder="Enter Email Id" required />
      </div>
      <div class="oneline">
        <input style="margin-left: 150px" class="btn_1" type="submit" class="btn btn-primary" value="Search"/>
      </div>
    </div>
  </form>
  <hr>
  
  <div class="basic_1">
    <h3 class="profile_title" style="margin: 5px; padding: 5px;"><b>Search By ID</b> </h3>
  </div>
  <form method="get" action="/admin/getuser">
  @csrf
    <div class="form-group">
      <div class="oneline">
        <input style="margin-left: 10px; width: 200px" class="form-control" type="text" name="userid" placeholder="Enter User Id" required />
      </div>
      <div class="oneline">
        <input style="margin-left: 150px" class="btn_1" type="submit" class="btn btn-primary" value="Search"/>
      </div>
    </div>
  </form>
  <form method="get" action="/admin/getprofile">
  @csrf
    <div class="form-group">
      <div class="oneline">
        <input style="margin-left: 10px; width: 200px" class="form-control" type="text" name="profileid" placeholder="Enter Profile Id" required />
      </div>
      <div class="oneline">
        <input style="margin-left: 150px" class="btn_1" type="submit" class="btn btn-primary" value="Search"/>
      </div>
    </div>
  </form>
  </div>
  <hr>
  <br>
  <div class="clearfix"> </div>
</div>

</div>

@endsection