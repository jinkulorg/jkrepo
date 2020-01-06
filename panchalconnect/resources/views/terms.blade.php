@extends('layouts.app')

@section('content')
<div class="grid_3">
  <div class="container">
    <div class="breadcrumb1">
      <ul>
        <a href="/"><i class="fa fa-home home_1"></i></a>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page">Terms and Conditions</li>
      </ul>
    </div>
    <div class="terms_1">
      <h3>Once you are registered with PanchalConnect, you are bound with following terms and conditions</h3>
      <br>
      <b>Please read this carefully</b><br><br>
      <ul class="feature_list">
        <li>1. Create your profile with correct details. If we find any wrong informaiton, we will delete the profile without any consent of the user.</li>
        <li>2. If someone reports any profile to be abusive then we will remove the profile immediately without any consent of the user.</li>
        <li>3. Once payment done will never be refunded back in any case.</li>
        <li>4. Your profile will be active for only one year. You will need to renew your profile to make it active again.</li>
        <li>5. We are not responsible for any kind of problem.</li>
      </ul>
      <br>
      <p style="font-family: code">
        <b>Please note: panchalconnect is only for the users with a intent of marriage and is not for the users interested in dating. Panchalconnect platform should not be used to post any obscene material, such actions may lead to permanent deletion of the profile used to upload such content. </b>
      </p>

    </div>
  </div>
  @endsection