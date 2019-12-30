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
            <hr><br>
            <?php
            foreach ($filteredProfiles as $profile) {
                if ($ageGreaterThan != null and $ageLessThan != null) {
                    $age = $profile->age();
                    if (!($age >= $ageGreaterThan and $age <= $ageLessThan)) {
                        continue;
                    }
                }
                ?>
                Profile id: {{$profile->id}} <br>
                Name: {{$profile->user->name}} {{$profile->user->lastname}} <br>
                Designation: {{$profile->designation}} <br>
                Age: {{$profile->age()}} <br>
                <hr>
            <?php } ?>
        </div>
    </div>
</div>
@endsection