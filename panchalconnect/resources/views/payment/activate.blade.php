<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

@include("/config/config_panchalconnect.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
@extends('layouts.app')

@section('content')
<div class="grid_3">
	<div class="container">
		<div class="breadcrumb1">
			<ul>
				<a href="/"><i class="fa fa-home home_1"></i></a>
				<span class="divider">&nbsp;|&nbsp;</span>
				<li class="current-page">Activate Profile</li>
			</ul>
		</div>
		@if(Auth::User()->profile == null)
			<div class="alert alert-info">
				<h3><b><i class='fa fa-info-circle' aria-hidden='true'></i> 
					Please <a href="{{route('profile.create')}}"> create</a> your profile and then activate<b></h3>
			</div>
		@elseif(Auth::User()->profile->status == "RENEW")
			 <div class="alert alert-info">
				<h3><b><i class='fa fa-info-circle' aria-hidden='true'></i> 
					Your profile is INACTIVE. Kindly activate again to renew it.<b></h3>
			</div>
		@endif
		<?php
			if (Auth::User() != null && Auth::User()->profile != null && Auth::User()->profile->isActive()) {
				$paymentController = new App\Http\Controllers\PaymentController();
				$paymentDetails = $paymentController->getPaymentDetailsForActivateProfile();
				?>
					@if($paymentDetails != null)
					 <div class="alert alert-success">
						<h3><b><i class='fa fa-check' aria-hidden='true'></i> Thank you for registering with us!</b> <br><br>
							Your profile is active and all the below listed benefits are granted.</h3><br><br>
						<div class="row">
							<div class="col-sm-2" style="line-height: 2em">
								<b>Status:</b><br>
								<b>Payment Id</b><br>
								<b>Amount Paid</b><br>
								<b>Validity:</b><br>
								<b>Next Renewal Date:</b><br>
								
							</div>
							<div class="col-sm-4" style="line-height: 2em">
								ACTIVE<br>
								{{$paymentDetails->ORDERID}}<br>
								Rs. {{$paymentDetails->TXNAMOUNT}}/-<br>
								From {{date('d-M-Y', strtotime($paymentDetails->START_DATE))}} to {{date('d-M-Y', strtotime($paymentDetails->END_DATE))}}<br>
								{{ date('d-M-Y', strtotime("+1 days", strtotime($paymentDetails->END_DATE) )) }}<br>
							</div>
						</div>
					</div>
					@else
					<div class="alert alert-danger">
        			    <ul>
        			        <li>
								<b><i class='fa fa-times' aria-hidden='true'></i> It seems that your profile is active but payment information is not available.</b><br><br>
							</li>
        			    </ul>
        			</div>
					@endif    
					<hr>
				<?php
			} else {
		?>
		<div class="basic_1 alert alert-info" style="display: <?php echo (OFFER_AMOUNT != null) ? "block" : "none"?>; border: 2px solid gray; border-radius: 35px">
			<div style="font-size: 25px; ">
				<h3 style="text-align: center">
					<b style="text-shadow: 4px 4px 8px white, 8px 8px 8px #da8698;">
						<i class="fa fa-star" aria-hidden="true"></i> Short Term Offer <i class="fa fa-star" aria-hidden="true"></i>
					</b>
				</h3>
				<hr>
				<h3 style="text-align: center; line-height: 2em">
					@if(OFFER_FREE == "FREE")
					<b>
						Activate your profile for FREE instead of <s>Rs. {{AMOUNT}}/-</s>
						<br>Free to use panchal connect for six months 
						<br>Hurry!! Offer valid till {{OFFER_END_DATE}} for first 50 profiles
					</b>
					@else
					<b>
						Activate your profile for just Rs. {{OFFER_AMOUNT}}/- instead of <s>Rs. {{AMOUNT}}/-</s> 
						<br>Hurry!! Offer valid till {{OFFER_END_DATE}}
					</b>
					@endif
				</h3>
			</div>
		</div>
		<?php
			}
		?>
		<div class="basic_1">
			<div class="list-heading"><strong>Benefits on Activate Profile</strong></div>
			<br>
			<ul>
				<div class="listitem">
					<li><i class="fa fa-check" aria-hidden="true"></i> Your profile will be visible to others.</li>
				</div>
				<div class="listitem">
					<li><i class="fa fa-check" aria-hidden="true"></i> You will be able to send or unsend interest/request to any profiles. There will not be any limit to send request.</li>
				</div>
				<div class="listitem">
					<li><i class="fa fa-check" aria-hidden="true"></i> Once your request sent is accepted, you will be able to see the communication details of that profile like contact number, address, etc.</li>
				</div>
				<div class="listitem">
					<li><i class="fa fa-check" aria-hidden="true"></i> You can respond as interested or not interested to someone's request sent to you. If you respond as intersted then your contact details will be visible to the sender.</li>
				</div>
				@if(PROMOTE_ENABLED)
				<div class="listitem">
					<li><i class="fa fa-check" aria-hidden="true"></i> You can promote profile to get your profile on the first page which is highlighted under featured profiles based on the promotion plan subscribed.</li>
				</div>
				@endif
				<div class="listitem">
					<li><i class="fa fa-check" aria-hidden="true"></i> You can search for such profiles whose references are in common with yours.</li>
				</div>
			</ul>
		</div>
		<hr>
		

		<?php
		if (Auth::User() != null && Auth::User()->profile != null && !Auth::User()->profile->isActive()) {
			?>
			<h3>
				@if(OFFER_FREE == "FREE")
				<b>
					<i class="fa fa-arrow-right" aria-hidden="true"></i> Its FREE for now to activate your profile and get these benefits for six months
				</b>
				@else
				<b>
					<i class="fa fa-arrow-right" aria-hidden="true"></i> Pay only <?php echo (OFFER_AMOUNT != null) ? "<s>Rs. " . AMOUNT . "/-</s> Rs. " . OFFER_AMOUNT . "/-" : "Rs. " . AMOUNT . "/-" ?> to activate your profile and get these benefits for one year
				</b>
				@endif
			</h3>
			<br>
			<form id="payment_form" method="post" action="/pgRedirect">
				@csrf
				<table>
					<tbody>
						<tr>
							<td>

								<!-- <input type="checkbox" id="confirm" name="confirm" value="confirm" />
								&nbsp;Confirm that your profile id is {{Auth::User()->profile->id}} and your name is {{Auth::User()->name}} {{Auth::User()->lastname}} -->
							</td>
						</tr>
						<tr>
							<!-- <td><label>Profile Id: {{Auth::User()->profile->id}} </label></td>
							<td><label>Name: {{Auth::User()->name}} {{Auth::User()->lastname}} </label></td> -->
						</tr>
						<tr>
							<!-- <td><label>Payment ID: </label></td> -->
							<td><input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo  "PAY" . rand(10000, 99999999) ?>" hidden>
							</td>
						</tr>
						<tr>
							<!-- <td><label>Profile Id: </label></td> -->
							<td><input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="{{Auth::User()->profile->id}}" hidden></td>
						</tr>
						<tr>
							<td><input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail" hidden></td>
						</tr>
						<tr>
							<td><input id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB" hidden>
							</td>
						</tr>
						<tr>
							<!-- <td><label>Amount</label></td> -->
							<td><input title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php echo (OFFER_AMOUNT != null) ? OFFER_AMOUNT : AMOUNT?>" hidden>
							</td>
						</tr>
						<input id="SOURCE" name="SOURCE" value="P" hidden>
						<tr>
							<td>
								<!-- <input class="my-buttons" value="Proceed to pay Rs. 351" type="submit" > -->
							</td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</form>
			<form id="activate_free_form" action="{{action('ProfilesController@activateProfileForFree',Auth::User()->profile->id)}}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PATCH" />
                <!-- <input type="submit" value="Activate" /> -->
            </form>

			<div class="buttons">
			@if(OFFER_FREE == "FREE")
				<div class="my-buttons">
					<a href="#" class="my-buttons" style="text-align: center" onclick="activateFreeClicked()">Proceed to activate your profile</a>
				</div>
			@else
				<div class="my-buttons">
					<a href="#" class="my-buttons" style="text-align: center" onclick="paymentClicked()">Proceed to pay <?php echo (OFFER_AMOUNT != null) ? "<s>Rs. " . AMOUNT . "</s> Rs. " . OFFER_AMOUNT : "Rs. ". AMOUNT ?></a>
				</div>
			@endif
			</div>
		<?php
		}
		?>
	</div>
</div>
<script type="text/javascript">
	function paymentClicked() {
		// if (document.getElementById("confirm").checked == false) {
		// 	alert("Please confirm and then proceed to pay.");
		// 	return;
		// }
		document.getElementById("payment_form").submit();
	}
	function activateFreeClicked() {
		document.getElementById("activate_free_form").submit();
	}
</script>
@endsection