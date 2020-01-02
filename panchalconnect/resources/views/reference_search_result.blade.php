@extends('layouts.app')

@section('content')
<div class="grid_3">
    <div class="container">
        <div class="breadcrumb1">
            <ul>
                <a href="/"><i class="fa fa-home home_1"></i></a>
                <span class="divider">&nbsp;|&nbsp;</span>
                <li class="current-page">Search Result</li>
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
            <div class="alert alert-success">
            <?php
            echo sizeof($filteredProfiles) . " records found <br>";
            ?>
            </div>
            <hr><br>
            @foreach ($filteredProfiles as $referenceId => $profile)
                <?php
                $reference = app\Reference::find($referenceId);
                ?>
                Profile id: {{$profile->id}} <br>
                Name: {{$profile->user->name}} {{$profile->user->lastname}} <br>
                Designation: {{$profile->designation}} <br>
                Age: {{$profile->age()}} <br>
                status: {{$profile->marital_status}} <br>
                Shani: {{$profile->shani}}<br>
                Mangal: {{$profile->mangal}}<br>
                Annual Income: {{$profile->annual_income}}<br>
                <b>Mutual Reference:</b> {{$reference->first_name}} {{$reference->last_name}} ({{$reference->city}})<br> 
                <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection