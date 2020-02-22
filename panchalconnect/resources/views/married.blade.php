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
            <div id="validationError" class="alert alert-danger" style="display: none">
            <ul>
                <li>Please fill up all the highlighted fields</li>
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

                    <form id="marriedForm" method="post" action="{{url('married')}}">
                        @csrf
                        <div class="form-group" style="width: 62%">
                            <input type="text" name="marriage_date" class="form-control" placeholder="Enter your Marriage Date (DD-MMM-YYYY)" oninput="this.className = 'form-control'"/>
                        </div>
                        <div class="form-group" style="width: 62%">
                            <input type="text" name="with_profile_id" class="form-control" <?php if ($with_profile_id != null) {
                                                                                                echo 'value="' . $with_profile_id . '" readonly';
                                                                                            } ?> placeholder="Enter your life partner's Panchal Connect Profile ID if exist (Optional)" oninput="this.className = 'form-control'"/>
                        </div>
                        <div class="form-group" style="width: 62%">
                            <input type="text" name="with_person_name" class="form-control" <?php if ($with_profile_id != null) {
                                                                                                echo 'value="' . $with_person_name . '" readonly';
                                                                                            } ?> placeholder="Enter your life partner's full name" oninput="this.className = 'form-control'" />
                        </div>
                        <div class="form-group">
                            <div class="row">
                            <div class="col-sm-6">
                            <label>Was 'Reference Based Search' useful in using our service? </label>
                            </div>
                            <div class="col-sm-6">
                            <span id="spanreference_useful1">
                                <input type="radio" name="reference_useful" id="reference_useful" value="1" onchange="validSpan('spanreference_useful1','spanreference_useful0')"> Yes &nbsp;&nbsp;
                            </span>
                            <span id="spanreference_useful0">
                                <input type="radio" name="reference_useful" id="reference_useful" value="0" onchange="validSpan('spanreference_useful1','spanreference_useful0')"> No
                            </span></div>
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                            <label>Are you satisfied with the service provided? </label>
                            </div>
                            <div class="col-sm-6">
                            <span id="spanservice_satisfied1">
                                <input type="radio" name="service_satisfied" id="service_satisfied" value="1" onchange="validSpan('spanservice_satisfied1','spanservice_satisfied0')"> Yes &nbsp;&nbsp;
                            </span>
                            <span id="spanservice_satisfied0">
                                <input type="radio" name="service_satisfied" id="service_satisfied" value="0" onchange="validSpan('spanservice_satisfied1','spanservice_satisfied0')"> No
                            </span>
                            </div>
                        </div>
                        </div>
                        <div class="form-group" style="width: 62%">
                            <textarea name="feedback" id="feedback" class="form-control" placeholder="Describe your experience using panchal connect" oninput="this.className = 'form-control'"></textarea>
                        </div>
                        <div class="form-group">
                            <!-- <input type="button" class="btn btn-primary" value="Confirm" onclick="validateForm()" /> -->
                        </div>
                </div>
            </div>
            <div class="buttons">
				<div class="my-buttons">
					<a href="#" class="my-buttons" style="text-align: center; " onclick="validateFormAndSubmit()">Confirm</a>
				</div>
			</div>
            @endif

        </div>

    </div>
</div>
<script type="text/javascript">
    function validateFormAndSubmit() {
        var valid = true;
        var i;
        var inputs = document.getElementsByTagName("input");
        for (i = 0; i < inputs.length; i++) {
            if (inputs[i].type == "radio") {
                radioOptions = document.getElementsByName(inputs[i].name);
                var checked = false;
                for (j = 0; j < radioOptions.length; j++) {
                    if (radioOptions[j].checked == true) {
                        checked = true;
                        break;
                    }
                }
                if (checked == false) {
                    for (j = 0; j < radioOptions.length; j++) {
                        var spanId = "span" + radioOptions[j].name + radioOptions[j].value;
                        span = document.getElementById(spanId);
                        span.className = "checkmark";
                    }
                    valid = false;
                }
            } else if (inputs[i].value == "" && inputs[i].placeholder.trim().includes('Optional') == false) {
                inputs[i].className += " invaliddata";
                valid = false;
            }
        }
        var feedback = document.getElementById("feedback");
        if (feedback.value == "") {
            // add an "invalid" class to the field:
            feedback.className += " invaliddata";
            // and set the current valid status to false:
            valid = false;
        }

        if (valid) {
            document.getElementById("marriedForm").submit();
        } else {
            document.getElementById("validationError").style.display = "block";
            return;
        }
    }
    
    function validSpan(spanid1, spanid2) {
        var span = document.getElementById(spanid1);
        span.className = "";
        span = document.getElementById(spanid2);
        span.className = "";
    }

</script>
@endsection