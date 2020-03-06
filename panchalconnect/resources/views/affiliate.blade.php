@extends('layouts.app')

@section('content')
<div class="grid_3">
    <div class="container">
        <div class="breadcrumb1">
            <ul>
                <a href="/"><i class="fa fa-home home_1"></i></a>
                <span class="divider">&nbsp;|&nbsp;</span>
                <li class="current-page">Affiliate Program</li>
            </ul>
        </div>
        <hr>
        @auth
        <div class="basic_3" style="text-align: center">
            <h4>Welcome to our Affiliate Program</h4>
        </div>
        <ul class="login_details1" style="text-align: center">
            <li>Earn money on Panchal Connect</li>
        </ul>
        <br>
        <p>
            Earning money on Panchal Connect requires you to refer people who will register on panchal connect.
            Once they register, they have to create their profile and most important is to activate their profile only then you will earn commission on your refferals.
            To refer, you just need to share below generated affiliate link to other people.

        </p>
        @else
        <div class="alert alert-info">
            <h3><b><i class='fa fa-info-circle' aria-hidden='true'></i>
                    Please Login/register to use Affiliate Program.<b></h3>
        </div>
        @endauth
        <hr>
        @auth
        Your affilate link: <input type="text" readonly="readonly" value="{{ url('/') . '/?ref=' . Auth::user()->id }}">
        <div class="oneline" style="width: auto; text-align: right">
            <ul class="login_details1">
                <li>[Share this generated affiliate link with other people and earn money]</li>
            </ul>
        </div>
        <hr>
        <div class="basic_1">
            <h3 class="profile_title" style="margin: 5px; padding: 5px;"><b>Your Refferals</b> </h3>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Account Created at</th>
                    <th>Last login date</th>
                    <th>Profile Created</th>
                    <th>Profile Active</th>
                    <th>Earned (INR)</th>
                </tr>
                <?php
                $totalAmountEarned = 0;
                ?>
                @foreach($referredUsers as $referredUser)
                <tr>
                    <td>{{$referredUser['name']}}</td>
                    <td>{{$referredUser['lastname']}}</td>
                    <td>{{$referredUser['created_at']}}</td>
                    <td>{{$referredUser['last_login_date']}}</td>
                    <td style="text-align: center"><?php echo ($referredUser->profile != null) ? "Yes" : "No" ?></td>
                    <td style="text-align: center"><?php echo ($referredUser->profile != null && ($referredUser->profile->status == "ACTIVE" || $referredUser->profile->status == "RENEW" || $referredUser->profile->status == "MARRIED")) ? "Yes" : "No" ?></td>
                    <td style="text-align: center"><?php echo ($referredUser->profile != null && ($referredUser->profile->status == "ACTIVE" || $referredUser->profile->status == "RENEW" || $referredUser->profile->status == "MARRIED")) ? "50" : "0" ?></td>
                    <?php
                    if (($referredUser->profile != null && ($referredUser->profile->status == "ACTIVE" || $referredUser->profile->status == "RENEW" || $referredUser->profile->status == "MARRIED"))) {
                        $totalAmountEarned += 50;
                    }
                    ?>
                </tr>
                @endforeach
                <tr>
                    <td colspan="6" style="text-align: right"><b>Total Amount Earned</b></td>
                    <td style="text-align: center"><b>{{$totalAmountEarned}}</b></td>
                </tr>
            </table>
        </div>
        <i>Note: You will earn only when profile created is "Yes" and also profile active is "Yes". You can withdraw money once you earned more than Rs. 500/-</i>
        <div class="clearfix"> </div>
        <hr>
        @endauth
    </div>
    @endsection