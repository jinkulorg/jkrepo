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
		@if(Session::has('success'))
        <div class="alert alert-success">
            <p><i class='fa fa-check' aria-hidden='true'></i> {{Session::get('success')}}</p>
        </div>
        @endif
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
							Your profile is active and all the below listed benefits are granted. <a href="{{action('ProfilesController@show',Auth::User()->Profile->id)}}">View your profile</a></h3><br><br>
						<div class="row">
							<div class="col-sm-12" style="line-height: 2em">
								<b>Status:</b> ACTIVE<br>
								<b>Payment Id:</b> {{$paymentDetails->ORDERID}}<br>
								<b>Amount Paid:</b> Rs. {{$paymentDetails->TXNAMOUNT}}/-<br>
								<b>Validity: </b> From {{date('d-M-Y', strtotime($paymentDetails->START_DATE))}} to {{date('d-M-Y', strtotime($paymentDetails->END_DATE))}}<br>
								<b>Next Renewal Date:</b> {{ date('d-M-Y', strtotime("+1 days", strtotime($paymentDetails->END_DATE) )) }}<br>
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
		
		<?php
			}
		?>
		
		<?php
		if (Auth::User() != null && Auth::User()->profile != null && !Auth::User()->profile->isActive()) {
			$totalMaleProfiles = App\Profile::where('STATUS','!=','INACTIVE')->where('gender','=','M')->get()->count();
			$totalFemaleProfiles = App\Profile::where('STATUS','!=','INACTIVE')->where('gender','=','F')->get()->count();
			$currentProfile = Auth::User()->profile;
			?>
			<h3>
				@if(OFFER_FREE == "FREE" && ($currentProfile->gender == 'M' && $totalMaleProfiles < MAX_FREE_PROFILE_FOR_BOYS) || ($currentProfile->gender == 'F' && $totalFemaleProfiles < MAX_FREE_PROFILE_FOR_GIRLS))
					<b>
						<i class="fa fa-arrow-right" aria-hidden="true"></i> 100% FREE for GIRLS to activate your profile and get these benefits for one year
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
							<td><input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo  "P" . $currentProfile->id . "PAY" . rand(10000, 99999999) ?>" hidden>
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
			@if(OFFER_FREE == "FREE" && ($currentProfile->gender == 'M' && $totalMaleProfiles < MAX_FREE_PROFILE_FOR_BOYS) || ($currentProfile->gender == 'F' && $totalFemaleProfiles < MAX_FREE_PROFILE_FOR_GIRLS))
				<div class="my-buttons">
					<a href="#" class="my-buttons" style="text-align: center" onclick="activateFreeClicked()">Proceed to activate your profile</a>
				</div>
			@else
			<div class="table-responsive">
			<table border="1" style="margin-left:auto; margin-right:auto;">
				<tr>
					<th colspan="2">
						<div style="margin: 30px 30px 30px 30px; text-align: center;">
							<h3><b>Payment Options</b></h3>
						</div>
					</th>
				</tr>
				<tr>
					<td>
						<div style="margin: 30px 30px 30px 30px">
							<b style="color: blue;">Pay</b><b style="color: lightskyblue;">tm</b> / <b style="color: grey;"><i>UPI</i></b>
						</div>
					</td>
					<td>
						<div class="my-buttons" style="margin: 30px 30px 30px 30px">
							<a href="#" class="my-buttons" style="text-align: center" onclick="paymentClicked()">Proceed to pay <?php echo (OFFER_AMOUNT != null) ? "Rs. " . OFFER_AMOUNT : "Rs. ". AMOUNT ?></a>
							<br>Automatic Activation after payment
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div style="margin: 30px 30px 30px 30px">
							<b style="color: #c32143;">Bank Deposit</b>
						</div>
					</td>
					<td>
						<div style="margin: 30px 30px 30px 30px">
							<b>Bank Name:</b> SBI
							<br><b>Account Name:</b> Jinkal Panchal
							<br><b>Account No:</b> 37523768384
							<br><b>IFSC Code:</b> SBIN0019050
							<br>After payment, send us your transaction id, profile id and amount paid on whatsapp (9426155564) or email (info@panchalconnect.com).
							<br>We will activate your profile within 24hours.
						</div>
					</td>
				</tr>
			</table>
			</div>
			@endif
			</div>
		<?php
		}
		?>
		<hr>
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