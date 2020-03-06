@extends('layouts.app')

@section('content')
<div class="grid_3">
    <div class="container">
        <div class="breadcrumb1">
            <ul>
                <a href="/"><i class="fa fa-home home_1"></i></a>
                <span class="divider">&nbsp;|&nbsp;</span>
                <li class="current-page">Account</li>
            </ul>
        </div>
        @auth
        @if(\Session::has('success'))
        <div class="alert alert-success">
            <p><i class='fa fa-check' aria-hidden='true'></i> {{\Session::get('success')}}</p>
        </div>
        @endif
        <table width=100%>
            <td>
                <div class="basic_1">
                    <h3 class="profile_title" style="margin: 5px; padding: 5px;"><b>Your Account Details</b></h3>
                </div>
            </td>
            <td>
                <div class="basic_1">
                    <h4 style="text-align: right;"><a class="btn_2" href="#" onclick="editAccountForm()">Edit Details</a></h4>
                </div>
            </td>
        </table>
        <div class="row">
            <div class="col-md-12">

                <form id="accountForm" method="post" action="{{action('AccountController@update',$user->id)}}">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH" />
                    <div class="form-group">
                        <input type="text" id="firstname" name="firstname" class="form-control @error('name') is-invalid @enderror " value="{{$user->name}}" placeholder="Enter your first name" readonly required />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" id="lastname" name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{$user->lastname}}" placeholder="Enter your last name" readonly required />
                        @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}" placeholder="Enter your email id" readonly required autocomplete="email" />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div id="buttonDiv" class="form-group" style="display: none">
                        <input class="btn_1" id="saveButton" onclick="submitForm()" type="button" value="Save" disabled />
                    </div>
                </form>
            </div>
        </div>
        @else
        <div class="alert alert-info">
            <h3><b><i class='fa fa-info-circle' aria-hidden='true'></i>
                    Please Login/register.<b></h3>
        </div>
        @endauth
    </div>
    <script type="text/javascript">
        function editAccountForm() {
            document.getElementById('firstname').removeAttribute('readonly');
            document.getElementById('lastname').removeAttribute('readonly');
            document.getElementById('email').removeAttribute('readonly');
            document.getElementById('saveButton').removeAttribute('disabled');
            document.getElementById('buttonDiv').style.display = "block";
        }

        function submitForm() {
            document.getElementById('buttonDiv').style.display = "none";
            document.getElementById('accountForm').submit();
        }
    </script>
    @endsection