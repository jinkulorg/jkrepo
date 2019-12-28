@extends('layouts.app')

@section('content')
<div class="grid_3">
    <div class="container">
        <div class="breadcrumb1">
            <ul>
                <a href="/"><i class="fa fa-home home_1"></i></a>
                <span class="divider">&nbsp;|&nbsp;</span>
                <li class="current-page">Promote Profile</li>
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
            @if(\Session::has('success'))
            <div class="alert alert-success">
                <p>{{\Session::get('success')}}</p>
            </div>
            @else
            <?php
            $featuredProfileCount = Auth::User()->profile->FeaturedProfile->whereIn('status', ['APPROVED', 'REQUESTED'])->count();
            ?>
            @if($featuredProfileCount != 0)
            <div class="alert alert-success">
                <?php
                echo "Your profile is already promoted";
                ?>
                <br><br>
            </div>
            @else

            <pre>
                Plan Details:
    
                Plan 1: 
                        Period: 1 Month
                        Amount: Rs. 100
    
                Plan 2: 
                        Period: 6 Months
                        Amount: Rs. 500
    
                Plan 3: 
                        Period: 12 Months
                        Amount: Rs. 1000
                
                </pre>
            <div class="row">
                <div class="col-md-12">

                    <form method="post" action="{{url('featuredprofile')}}">
                        @csrf
                        <div class="form-group">
                            <select class="form-control" id="plan" name="plan">
                                <option selected disabled hidden value="">--Select Plan--</option>
                                <option value="plan1">Plan 1</option>
                                <option value="plan2">Plan 2</option>
                                <option value="plan3">Plan 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Note: Your profile will be promoted on {{date("d - M - Y")}} or the date when your request is approved.
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Send Request to promote profile" />
                        </div>
                    </form>
                </div>
            </div>
            @endif
            @endif
        </div>
    </div>
</div>
@endsection