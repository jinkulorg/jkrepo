@extends('layouts.adminapp')

@section('content')
<br>
<div class="container">
    <div class="breadcrumb1">
        <ul>
            <a href="/admin"><i class="fa fa-home home_1"></i></a>
            <span class="divider">&nbsp;|&nbsp;</span>
            <li class="current-page">New Request Received</li>
        </ul>
    </div>
    
    <br>
    @if(Session::has('success'))
    <div class="alert alert-success">
        <p>{{Session::get('success')}}</p>
    </div>
    @endif
    
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th>Profile Id</th>
                <th>Contact No</th>
                <th>Message</th>
            </tr>
            @foreach($profiles as $profileid => $fromList)
            <tr>
                <td>{{$profileid}}</td>
                <td>{{App\Profile::find($profileid)->contact_no}}</td>
                <td>
                    <?php
                        $fromListArray = explode(",",$fromList);
                        $totalRequest = sizeof($fromListArray);
                    ?>
                    Hi {{App\Profile::find($profileid)->user->name}} {{App\Profile::find($profileid)->user->lastname}},
                    <br><br>
                    You have received {{$totalRequest}} new request from {{$fromList}}. 
                    <br>So, please Login into Panchal Connect and go to "Requests" menu and check all request received.
                    <br><br>For each request,
                    <br>If you like profile and want to share contact details: click "Interested"
                    <br>If you do not like profile and do not want to share contact: click "Not Interested"
                    <br><br>
                    You are receiving this message because you are registered in Panchal Connect.<br><br>
                    Thanks,<br>
                    Panchal Connect<br>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="clearfix"> </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete_form').on('submit', function() {
            if (confirm('Are you sure you want to delete it?')) {
                return true;
            } else {
                return false;
            }
        });
    });
</script>
@endsection