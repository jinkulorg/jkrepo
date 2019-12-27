@extends('layouts.app')

@section('content')
<div class="grid_3">
    <div class="container">
        <div class="breadcrumb1">
            <ul>
                <a href="/"><i class="fa fa-home home_1"></i></a>
                <span class="divider">&nbsp;|&nbsp;</span>
                <li class="current-page">Got Married</li>
            </ul>
            <br>
            @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(Auth::User()->profile->status == "MARRIED")
            <div class="alert alert-success">
                <?php
                    $marriedControlle = new App\Http\Controllers\MarriedController();
                    echo $marriedControlle->getMarriageStatus();
                ?>
                <br><br>
                <h4>To correct your marriage information, please contact <a href="/contact">administrator</a>.</h4>
            </div>
            @else
            <div class="row">
                <div class="col-md-12">

                    <form method="post" action="{{url('married')}}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="marriage_date" class="form-control" placeholder="Enter your Marriage Date (DD-MMM-YYYY)" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="with_profile_id" class="form-control" <?php if ($with_profile_id != null) {
                                                                                                echo 'value="' . $with_profile_id . '" readonly';
                                                                                            } ?> placeholder="Enter your life partner's Panchal Connect Profile ID if exist" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="with_person_name" class="form-control" <?php if ($with_profile_id != null) {
                                                                                                echo 'value="' . $with_person_name . '" readonly';
                                                                                            } ?> placeholder="Enter your life partner's full name" />
                        </div>
                        <div class="form-group">
                            <label>Was 'Reference Based Search' useful in using our service? </label>
                            <input type="radio" name="reference_useful" value="1">Yes
                            <input type="radio" name="reference_useful" value="0">No
                        </div>
                        <div class="form-group">
                            <label>Are you satisfied with the service provided? </label>
                            <input type="radio" name="service_satisfied" value="1">Yes
                            <input type="radio" name="service_satisfied" value="0">No
                        </div>
                        <div class="form-group">
                            <textarea name="feedback" class="form-control" placeholder="Describe your experience using panchal connect"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Confirm" />
                        </div>
                </div>
            </div>
            @endif

        </div>

    </div>
</div>
@endsection