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

  <h1> Panchal Connect Statistics</h1>
  <h2>
    <div class="table-responsive">
      <table class="table table-striped">
        <tr>
          <td>Total User Accounts</td>
          <td>{{$totalUsers}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Total Active Profiles</td>
          <td>{{$totalActiveProfiles}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Total Inactive Profiles</td>
          <td>{{$totalInactiveProfiles}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Total Married</td>
          <td>{{$totalMarried}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>

      </table>
    </div>
  </h2>
  <div class="clearfix"> </div>
</div>

</div>

@endsection