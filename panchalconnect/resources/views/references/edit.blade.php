@extends('layouts.app')

@section('content')
<div class="grid_3">
    <div class="container">
        <div class="breadcrumb1">
            <ul>
                <a href="/"><i class="fa fa-home home_1"></i></a>
                <span class="divider">&nbsp;|&nbsp;</span>
                <li class="current-page">Edit Reference</li>
            </ul>
        </div>

        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
               
                <form id="referenceForm" method="post" action="{{action('ReferenceController@update',$id)}}">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH"/>
                    <div class="form-group">
                        <input type="text" name="first_name" class="form-control" value="{{$reference->first_name}}" oninput="this.className = 'form-control'"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="second_name" class="form-control" value="{{$reference->second_name}}" placeholder="Enter second Name (Optional)"  />
                    </div>
                    <div class="form-group">
                        <input type="text" name="last_name" class="form-control" value="{{$reference->last_name}}" oninput="this.className = 'form-control'"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="relation" class="form-control" value="{{$reference->relation}}" placeholder="Enter your relation with this person (Optional)"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="state" class="form-control" value="{{$reference->state}}" oninput="this.className = 'form-control'"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="city" class="form-control" value="{{$reference->city}}" oninput="this.className = 'form-control'"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="pincode" class="form-control" value="{{$reference->pincode}}" placeholder="Enter pincode (Optional)"/>
                    </div>
                    <div class="form-group">
                        <input class="btn_1" type="button" onclick="validateForm()" class="btn btn-primary" value="Save Reference"/>
                    </div>
                </form>
            </div>
        </div>



        <div class="clearfix"> </div>
    </div>
</div>
<script type="text/javascript">
    function validateForm() {
        var valid = true;
        var i;
        var inputs = document.getElementsByTagName("input");
        for (i = 0; i < inputs.length; i++) {
            if (inputs[i].value == "" && inputs[i].placeholder.trim().includes('Optional') == false) {
                inputs[i].className += " invaliddata";
                valid = false;
            }
        }
        if (valid) {
            document.getElementById("referenceForm").submit();
        } else {
            return;
        }
    }
</script>
@endsection