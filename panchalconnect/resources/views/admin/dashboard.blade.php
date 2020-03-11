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
    <h3 class="profile_title" style="margin: 5px; padding: 5px;"><b>Search User</b> </h3>
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

  <hr>
  
  <div class="basic_1">
    <h3 class="profile_title" style="margin: 5px; padding: 5px;"><b>Search Profile</b> </h3>
  </div>

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
  <div class="basic_3">
    <h4 style="text-align: center"><b>Panchal Connect Statistics</b> </h4>
  </div>
  
    <div class="table-responsive">
      <table class="table table-striped" style="width: 60%; margin-left:auto; margin-right:auto;">
        <tr>
          <td colspan="2"> 
          <div class="basic_1">
              <h3 class="profile_title" style=" padding: 5px;"><b>User Accounts</b> </h3>
            </div>  
          </td>
        </tr>
        <tr>
          <td><b>Total User Accounts</b></td>
          <td style="text-align: right"><b>{{$totalUsers}}</b></td>
        </tr>
        <tr>
          <td></td>
          <td><br></td>
        </tr>
        <tr>
          <td colspan="2">
          <div class="basic_1">
              <h3 class="profile_title" style=" padding: 5px;"><b>User Profiles</b> </h3>
            </div>
          </td>
        </tr>
        <tr>
          <td>Total Active Profiles</td>
          <td style="text-align: right">{{$totalActiveProfiles}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Total Inactive Profiles</td>
          <td style="text-align: right">{{$totalInactiveProfiles}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Total Married</td>
          <td style="text-align: right">{{$totalMarried}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td><b>Total Profiles</b></td>
          <td style="text-align: right"><b>{{$totalProfiles}}</b></td>
        </tr>
        <tr>
          <td></td>
          <td><br></td>
        </tr>
        <tr>
          <td colspan="2">
          <div class="basic_1">
              <h3 class="profile_title" style=" padding: 5px;"><b>Payments</b> </h3>
            </div>
          </td>
          <td></td>
        </tr>
        <tr>
          <td>Total income from Activate Profile</td>
          <td style="text-align: right">{{$totalAmountReceivedForActivation}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Total income from Promote Profile</td>
          <td style="text-align: right">{{$totalAmountReceivedForPromotion}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td><b>Total Revenue</b></td>
          <td style="text-align: right"><b>{{$totalAmountReceived}}</b></td>
        </tr>
        <tr>
          <td></td>
          <td><br></td>
        </tr>
      </table>
    </div>
  </h4>
  <div class="clearfix"> </div>
</div>

</div>

@endsection