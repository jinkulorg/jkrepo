@extends('layouts.adminapp')

@section('content')
<br>
<div class="container">
    <div class="breadcrumb1">
        <ul>
            <a href="/admin"><i class="fa fa-home home_1"></i></a>
            <span class="divider">&nbsp;|&nbsp;</span>
            <li class="current-page">Edit Users</li>
        </ul>
    </div>
    <br>

    @if(count($errors)>0)
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <form action="{{action('AdminController@updateUser',$id)}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="PATCH" />
        <div class="form-group">
            <input type="text" name="name" value="{{$user->name}}" placeholder="Enter First Name" />
        </div>
        <div class="form-group">
            <input type="text" name="lastname" value="{{$user->lastname}}" placeholder="Enter Last Name" />
        </div>
        <div class="form-group">
            <input type="text" name="email" value="{{$user->email}}" placeholder="Enter Email" />
        </div>
        <div class="form-group">
            <input type="text" name="email_verified_at" value="{{$user->email_verified_at}}" placeholder="Enter Email Verified at" />
        </div>
        <div class="form-group">
            <input type="text" name="type" value="{{$user->type}}" placeholder="Enter Type" />
        </div>

        <input type="submit" value="Update" />
    </form>

    <div class="clearfix"> </div>
</div>

@endsection