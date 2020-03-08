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
        </div>
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
        @if(Auth()->user()->Profile == null)
            <div class="alert alert-info">
				<h3><b><i class='fa fa-info-circle' aria-hidden='true'></i> 
					Please <a href="{{route('profile.create')}}"> create</a> your profile<b></h3>
			</div>
        @else
        <?php
        $featuredProfileCount = Auth::User()->profile->FeaturedProfile->whereIn('status', ['APPROVED', 'REQUESTED'])->count();
        ?>
        @if($featuredProfileCount != 0)
            <?php
                $paymentController = new App\Http\Controllers\PaymentController();
                $paymentDetails = $paymentController->getPaymentDetailsForPromoteProfile();
                
			    ?>
                    @if($paymentDetails != null)
                    <?php
                        $amountPaid = $paymentDetails->TXNAMOUNT;
                        $planName = "";
                        if ($amountPaid == PLAN1_AMOUNT) {
                            $planName = "SILVER";
                        } else if ($amountPaid == PLAN2_AMOUNT) {
                            $planName = "GOLD";
                        } else if ($amountPaid == PLAN3_AMOUNT) {
                            $planName = "PLATINUM";
                        }
                    ?>
			    	 <div class="alert alert-success">
			    		<h3><b><i class='fa fa-check' aria-hidden='true'></i> Thank you for promoting your profile!</b> <br><br>
			    			Your profile is promoted succesfully for <?php echo ($planName == "") ? "free": $planName . "  plan"; ?> and your profile is visilbe on home page under featured profiles.</h3><br><br>
			    		<div class="row">
			    			<div class="col-sm-2" style="line-height: 2em">
			    				<b>Status:</b><br>
			    				<b>Payment Id</b><br>
			    				<b>Amount Paid</b><br>
			    				<b>Validity:</b><br>
			    			</div>
			    			<div class="col-sm-4" style="line-height: 2em">
			    				PROMOTED<br>
			    				{{$paymentDetails->ORDERID}}<br>
			    				Rs. {{$paymentDetails->TXNAMOUNT}}/-<br>
			    				From {{date('d-M-Y', strtotime($paymentDetails->START_DATE))}} to {{date('d-M-Y', strtotime($paymentDetails->END_DATE))}}<br>
			    			</div>
                        </div>
                        <br>
                        We hope you will promote your profile again in future.
			    	</div>
			    	@else
			    	<div class="alert alert-danger">
        	    	    <ul>
        	    	        <li>
			    				<b><i class='fa fa-times' aria-hidden='true'></i> It seems that your profile is promoted but payment information is not available.</b><br><br>
			    			</li>
        	    	    </ul>
        	    	</div>
			    	@endif    
			    <?php
            ?>
            <br><br>
        @elseif(Auth::User()->profile->isActive())
        <hr>

        <div class="basic_3" style="text-align: center">
            <h4>Promote your profile to get highlighted in featured profiles on the home page of this website.</h4>
        </div>
        <hr>
        <br>

        <div class="offer-heading"><strong>Select plan to promote</strong></div>
        <br>
        <div class="basic_1">
            <div class="col-md-12">
                <div class="row">
                    <ul>
                        <!-- <div class="col-sm-1"></div> -->
                        <a  onclick="planSelected('plan1')">
                            <div class="col-sm-4">
                                <div id="plan1div" class="offer">
                                    <div class="offer-subheading">Silver Plan</div>
                                    <hr>
                                    <li>Promote for 1 Month<br>
                                        Price Rs. {{PLAN1_AMOUNT}}/-
                                    </li>
                                </div>
                            </div>
                        </a>
                        <!-- <div class="col-sm-1"></div> -->
                        <a onclick="planSelected('plan2')">
                            <div class="col-sm-4">
                                <div id="plan2div" class="offer">
                                    <div class="offer-subheading">Gold Plan</div>
                                    <hr>
                                    <li>Promote for 6 Months<br>
                                        Price Rs. {{PLAN2_AMOUNT}}/-
                                    </li>
                                </div>
                            </div>
                        </a>
                        <!-- <div class="col-sm-1"></div> -->
                        <a onclick="planSelected('plan3')">
                            <div class="col-sm-4">
                                <div id="plan3div" class="offer">
                                    <div class="offer-subheading">Platinum Plan</div>
                                    <hr>
                                    <li>Promote for 12 Months<br>
                                        Price Rs. {{PLAN3_AMOUNT}}/-
                                    </li>
                                </div>
                            </div>
                        </a>
                    </ul>
                </div>
                <div class="alert alert-warning">
                    <ul>
                        <li>
                            <b><i class='fa fa-warning' aria-hidden='true'></i> When your profile will expire, your promoted profile will be removed from featured profiles too. So, select plan accordingly.</b> 
		    	    	</li>
                    </ul>
                </div>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- <br><br><br><br><br><br><br><br><br><br> -->
                <form id="promote_form" method="post" action="/pgRedirect">
                    @csrf
                    <div class="form-group" style="display: none">
                        <select class="form-control" id="plan" name="plan">
                            <option selected disabled hidden value="">--Select Plan--</option>
                            <option value="plan1">Plan 1</option>
                            <option value="plan2">Plan 2</option>
                            <option value="plan3">Plan 3</option>
                        </select>
                    </div>
                    <div class="form-group">

                    </div>
                    <div class="form-group">
                        <!-- <label>Payment ID: </label> -->
                        <input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo  "FP" . rand(10000, 99999999) ?>" hidden>
                    </div>
                    <div class="form-group">
                        <!-- <label>Profile Id: </label> -->
                        <input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="{{Auth::User()->profile->id}}" hidden>
                    </div>
                    <input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail" hidden>
                    <input id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB" hidden>
                    <div class="form-group">
                        <!-- <label>Amount</label> -->
                        <input title="TXN_AMOUNT" tabindex="10" type="text" id="TXN_AMOUNT" name="TXN_AMOUNT" hidden>
                    </div>
                    <input id="SOURCE" name="SOURCE" value="FP" hidden>
                    <div class="form-group">
                    </div>
                </form>
            </div>
        </div>
        
        <div id="submitButtonDiv" class="buttons" style="display: none">
			<div class="my-buttons" style="text-align: center;">
				<a href="#" id="submitButton" class="my-buttons" style="text-align: center" onclick="paymentClicked()" >Proceed to pay</a>
			</div>
        </div>

        @else
            <div class="alert alert-warning">
                <ul>
                    <li>
                        <h3><b><i class='fa fa-warning' aria-hidden='true'></i> Your profile is INACTIVE. To promote your profile, Please activate your profile first.</b></h3> 
                        <br><br>
                        <h4><a href="/activate"><u>Click here</u></a> to activate.</h4>
		    		</li>
                </ul>
            </div>
        @endif
        @endif
        @endif

    </div>
</div>

<script type="text/javascript">
    
    function planSelected(plan) {
        var plan1div = document.getElementById('plan1div');
        var plan2div = document.getElementById('plan2div');
        var plan3div = document.getElementById('plan3div');
        var submitButtonDiv = document.getElementById('submitButtonDiv');
        var submitButton = document.getElementById('submitButton');
        submitButtonDiv.style.display = "block";
        submitButton.classname = "my-buttons";
        var amount = document.getElementById('TXN_AMOUNT');
        if (plan == "plan1") {
            plan1div.className = "offer offer-active";
            plan2div.className = "offer";
            plan3div.className = "offer";
            submitButton.innerHTML = "Proceed to pay Rs. <?php echo PLAN1_AMOUNT ?>";
            amount.value = <?php echo PLAN1_AMOUNT ?>;
        } else if (plan == "plan2") {
            plan2div.className = "offer offer-active";
            plan1div.className = "offer";
            plan3div.className = "offer";
            submitButton.innerHTML = "Proceed to pay Rs. <?php echo PLAN2_AMOUNT ?>";
            amount.value = <?php echo PLAN2_AMOUNT ?>;
        } else if (plan == "plan3") {
            plan3div.className = "offer offer-active";
            plan1div.className = "offer";
            plan2div.className = "offer";
            submitButton.innerHTML = "Proceed to pay Rs. <?php echo PLAN3_AMOUNT ?>";
            amount.value = <?php echo PLAN3_AMOUNT ?>;
        }
    }

    function paymentClicked() {
		document.getElementById("promote_form").submit();
	}
</script>
@endsection