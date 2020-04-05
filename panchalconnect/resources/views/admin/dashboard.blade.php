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
  <div class="basic_3">
    <h4 style="text-align: center"><b>Panchal Connect Statistics</b> </h4>
  </div>
  
    <div class="table-responsive">
      <table class="table table-striped" style="width: 60%; margin-left:auto; margin-right:auto;">
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
        <tr>
          <td colspan="2"> 
          <div class="basic_1">
              <h3 class="profile_title" style=" padding: 5px;"><b>User Accounts & Profiles</b> </h3>
            </div>  
          </td>
        </tr>
        <tr>
          <td><b>Total User Accounts</b></td>
          <td style="text-align: right"><b><a href="/manageuser">{{$totalUsers}}</a></b></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <!-- <tr>
          <td colspan="2">
          <div class="basic_1">
              <h3 class="profile_title" style=" padding: 5px;"><b>User Profiles</b> </h3>
            </div>
          </td>
        </tr> -->
        <tr>
          <td>Total Active Profiles</td>
          <td style="text-align: right"><a href="/admin/getActiveProfiles">{{$totalActiveProfiles}}</a></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Total Inactive Profiles</td>
          <td style="text-align: right"><a href="/admin/getInActiveProfiles">{{$totalInactiveProfiles}}</a></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Total Renew Profiles</td>
          <td style="text-align: right"><a href="/admin/getRenewProfiles">{{$totalRenewProfiles}}</a></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Total Married</td>
          <td style="text-align: right"><a href="/admin/getMarriedProfiles">{{$totalMarried}}</a></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td><b>Total Profiles</b></td>
          <td style="text-align: right"><b><a href="/manageprofile">{{$totalProfiles}}</a></b></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Total Active Male Profiles</td>
          <td style="text-align: right"><b><a href="/admin/getMaleProfiles">{{$totalActiveMaleProfiles}}</a></b></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Total Active Female Profiles</td>
          <td style="text-align: right"><b><a href="/admin/getFemaleProfiles">{{$totalActiveFemaleProfiles}}</a></b></td>
        </tr>
        <tr>
          <td></td>
          <td><br></td>
        </tr>
      </table>
    </div>
  <div class="clearfix"> </div>
</div>

</div>

@endsection