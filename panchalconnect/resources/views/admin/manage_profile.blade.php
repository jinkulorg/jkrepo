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

    <br>
    @if(\Session::has('success'))
    <div class="alert alert-success">
        <p>{{\Session::get('success')}}</p>
    </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th>Sr. No.</th>
                <th>Profile Id</th>
                <th>User Id</th>
                <th>First name</th>
                <th>Last name</th>
                <th>email</th>
                <th>Status</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Activate</th>
                <th>In-Activate</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php $i = 1; ?>
            @foreach($profiles as $profile)
            <tr>
                <td>{{$i}}</td>
                <td>{{$profile->id}}</td>
                <td>{{$profile->user_id}}</td>
                <td>{{$profile->user->name}}</td>
                <td>{{$profile->user->lastname}}</td>
                <td>{{$profile->user->email}}</td>
                <td>{{$profile->status}}</td>
                <td>{{$profile->created_at}}</td>
                <td>{{$profile->updated_at}}</td>
                <td>
                    <form action="{{action('AdminController@activate',$profile->id)}}" class="activate_form" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH" />
                        <input type="submit" value="Activate" />
                    </form>
                </td>
                <td>
                    <form action="{{action('AdminController@inactivate',$profile->id)}}" class="inactivate_form" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH" />
                        <input type="submit" value="In-Activate" />
                    </form>
                </td>
                <td><a href="{{action('ProfilesController@edit',$profile->id)}}">Edit</a></td>
                <td>
                    <form method="post" class="delete_form" action="{{action('AdminController@destroyProfile',$profile->id)}}">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE" />
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            <?php $i = $i + 1; ?>
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
            if (confirm('Are you sure you want to make profile in-active?')) {
                return true;
            } else {
                return false;
            }
        });
    });
</script>
@endsection