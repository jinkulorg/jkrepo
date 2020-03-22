@extends('layouts.app')

@section('content')
<div class="grid_3">
  <div class="container">
    <div class="breadcrumb1">
      <ul>
        <a href="/"><i class="fa fa-home home_1"></i></a>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page">Verify Your Email</li>
      </ul>
    </div>
        <div class="alert alert-danger">
			<b><i class='fa fa-info-circle' aria-hidden='true'></i>
				Thank you for registering! 
				<br>Before proceeding, please login to your {{Auth::user()->email}}. You would have got email from Panchal Connect with verification link. 
				<br>In that email, please click on verification link to verify it and then create your profile here.</b> 
				<br>If you did not receive the email, <a href="/email/resend">click here to request another.</a>
		</div>
    </div>
  @endsection