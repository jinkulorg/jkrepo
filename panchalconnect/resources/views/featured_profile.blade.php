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

                    <form method="post" action="/pgRedirect">
                        @csrf
                        <div class="form-group">
                            <select class="form-control" id="plan" name="plan" onchange="onPlanChange()">
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
                            <label>Payment ID: </label>
                            <input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo  "FP" . rand(10000, 99999999) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Profile Id: </label>
                            <input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="{{Auth::User()->profile->id}}" readonly>
                        </div>
                        <input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail" hidden>
                        <input id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB" hidden>
                        <div class="form-group">
                            <label>Amount</label>
                            <input title="TXN_AMOUNT" tabindex="10" type="text" id="TXN_AMOUNT" name="TXN_AMOUNT" readonly>
                        </div>
                        <input id="SOURCE" name="SOURCE" value="FP" hidden>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Pay" />
                        </div>
                    </form>
                </div>
            </div>
            @endif
            @endif
        </div>
    </div>
</div>
<script type="text/javascript">
function onPlanChange() {
    var selectedPlan = document.getElementById('plan');
    var amount = document.getElementById('TXN_AMOUNT');
    if (selectedPlan.value == "plan1") {
        amount.value = "100";
    } else if (selectedPlan.value == "plan2") {
        amount.value = "500";
    } else if (selectedPlan.value == "plan3") {
        amount.value = "1000";
    }
}
</script>
@endsection