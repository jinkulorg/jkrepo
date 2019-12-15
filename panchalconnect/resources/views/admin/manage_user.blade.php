@extends('layouts.adminapp')

@section('content')
<br>
<div class="container">
    <div class="breadcrumb1">
        <ul>
            <a href="/admin"><i class="fa fa-home home_1"></i></a>
            <span class="divider">&nbsp;|&nbsp;</span>
            <li class="current-page">Manage Users</li>
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
                <th>User Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Email verified at</th>
                <th>Type</th>
                <th>Remember token</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php $i = 1; ?>
            @foreach($users as $user)
            <tr>
                <td>{{$i}}</td>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->lastname}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->email_verified_at}}</td>
                <td>{{$user->type}}</td>
                <td>{{$user->remember_token}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at}}</td>
                <td><a href="{{action('AdminController@editUser', $user->id)}}">Edit</a></td>
                <td>
                    <form method="post" class="delete_form" action="{{action('AdminController@destroyUser',$user->id)}}">
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
</script>
@endsection