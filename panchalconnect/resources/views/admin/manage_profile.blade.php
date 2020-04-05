@extends('layouts.adminapp')

@section('content')
<br>
<div class="container">
    <div class="breadcrumb1">
        <ul>
            <a href="/admin"><i class="fa fa-home home_1"></i></a>
            <span class="divider">&nbsp;|&nbsp;</span>
            <li class="current-page">Manage Profile</li>
        </ul>
    </div>
    <b>Total Profiles: {{sizeof($profiles)}}</b>
    <br>
    @if(\Session::has('success'))
    <div class="alert alert-success">
        <p>{{\Session::get('success')}}</p>
    </div>
    @endif
    @if(\Session::has('failure'))
    <div class="alert alert-danger">
        <p>{{\Session::get('failure')}}</p>
    </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th>Profile Id</th>
                <th>User Id</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Contact</th>
                <th>Status</th>
                <th>Req. Sent</th>
                <th>Req. Rece</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Created at</th>
                <th>Updated at</th>
                <!-- <th>Activate For Free</th>
                <th>In-Activate</th>
                <th>Promote For Free</th>
                <th>Edit</th>
                <th>Delete</th> -->
            </tr>
            @foreach($profiles as $profile)
            <?php
                $paymentController = new App\Http\Controllers\PaymentController();
                $payment = $paymentController->getPaymentDetailsForActivateProfileFor($profile->id);
            ?>
            <tr>
               
                <td>
                    <a href="{{action('ProfilesController@show',$profile->id)}}">{{$profile->id}}</a>
                </td>
                <td><a href="/admin/getuser?userid={{$profile->user_id}}">U{{$profile->user_id}}</a></td>
                <td>
                    <?php
                    if (sizeof($profile->FeaturedProfile) != 0) {
                        ?>
                        <a href="/admin/getFeaturedProfile?profileid={{$profile->id}}">{{$profile->user->name}}</a>
                        <?php
                    } else {
                        ?>
                        {{$profile->user->name}}
                        <?php
                    }
                    ?>
                </td>
                <td>{{$profile->user->lastname}}</td>
                <td>{{$profile->contact_no}}</td>
                <td>{{$profile->status}}</td>
                <td>{{$profile->Request_sent->count()}}</td>
                <td>{{$profile->Request_received->count()}}</td>
                <td><?php echo ($payment != null)? $payment->START_DATE : "NOT FOUND"; ?></td>
                <td><?php echo ($payment != null)? $payment->END_DATE : "NOT FOUND"; ?></td>
                <td>{{$profile->created_at}}</td>
                <td>{{$profile->updated_at}}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="8">
                <div class="oneline">
                    <form action="{{action('ProfilesController@activateProfileForFree',$profile->id)}}" class="activate_form" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH" />
                        <input class="btn_1" style="margin-left: -120px" type="submit" value="Activate For Free" />
                    </form>
                </div>
                <!-- </td>
                <td> -->
                <div class="oneline">
                    <form action="{{action('AdminController@inactivate',$profile->id)}}" class="inactivate_form" method="post">
                    @csrf
                        <input type="hidden" name="_method" value="PATCH" />
                        <input class="btn_1" style="margin-left: -40px" type="submit" value="In-Activate" />
                    </form>
                </div>
                <!-- </td>
                <td colspan=3> -->
                <div class="oneline" style="width: 300px">
                    <form action="{{action('ProfilesController@promoteProfileForFree',$profile->id)}}" class="promote_form" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH" />
                        <div class="oneline">
                        <select class="form-control" id="plan" name="plan">
                            <option selected disabled hidden value="">Select Plan</option>
                            <option value="plan1">Plan 1</option>
                            <option value="plan2">Plan 2</option>
                            <option value="plan3">Plan 3</option>
                        </select>
                        </div>
                        <div class="oneline" >
                            <input style="margin-left: 5px" class="btn_1" type="submit" value="Promote For Free" />
                        </div>
                    </form>
                </div>
                <!-- </td>
                <td> -->
                <div class="oneline">
                    <a class="btn_1" style="margin-left: 40px" href="{{action('ProfilesController@edit',$profile->id)}}">Edit</a>
                </div>
                <!-- </td>
                <td> -->
                <div class="oneline">
                    <form method="post" class="delete_form" action="{{action('AdminController@destroyProfile',$profile->id)}}">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE" />
                        <button style="margin-left: 10px" class="btn_1" type="submit">Delete</button>
                    </form>
                </div>
                </td>
            </tr>
            <tr>
            <td colspan="12" style="background-color: lightgray"></td>
            </tr>
            @endforeach
        </table>
    </div>
    <?php
    if (sizeof($profiles) > 1) {
        echo $profiles->links();
    }
    ?>
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

    $(document).ready(function() {
        $('.activate_form').on('submit', function() {
            if (confirm('Are you sure you want to make profile active?')) {
                return true;
            } else {
                return false;
            }
        });
    });

    $(document).ready(function() {
        $('.inactivate_form').on('submit', function() {
            if (confirm('Are you sure you want to inactivate profile?')) {
                return true;
            } else {
                return false;
            }
        });
    });

    $(document).ready(function() {
        $('.promote_form').on('submit', function() {
            if (confirm('Are you sure you want to promote profile?')) {
                return true;
            } else {
                return false;
            }
        });
    });
</script>
@endsection