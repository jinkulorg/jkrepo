<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
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
				<div class="listitem">
					<li><i class="fa fa-check" aria-hidden="true"></i> You can promote profile to get your profile on the first page which is highlighted under featured profiles.</li>
				</div>
				<div class="listitem">
					<li><i class="fa fa-check" aria-hidden="true"></i> You can search for such profiles whose references are in common with yours.</li>
				</div>
			</ul>
		</div>
		<hr>
		<h3><b><i class="fa fa-arrow-right" aria-hidden="true"></i> Pay only Rs. 351/- to activate your profile and get these benefits for one year</b></h3>
		<br>

		<?php
		if (Auth::User() != null && Auth::User()->profile != null) {
			?>

			<form id="payment_form" method="post" action="/pgRedirect">
				@csrf
				<table>
					<tbody>
						<tr>
							<td>

								<input type="checkbox" id="confirm" name="confirm" value="confirm" />
								&nbsp;Confirm that your profile id is {{Auth::User()->profile->id}} and your name is {{Auth::User()->name}} {{Auth::User()->lastname}}
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
							<td><input title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="351" hidden>
							</td>
						</tr>
						<input id="SOURCE" name="SOURCE" value="P" hidden>
						<tr>
							<td><br>
								<!-- <input class="my-buttons" value="Proceed to pay Rs. 351" type="submit" > -->
							</td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</form>
			<div class="buttons">
				<div class="my-buttons">
					<a href="#" class="my-buttons" onclick="paymentClicked()">Proceed to pay Rs. 351</a>
				</div>
			</div>
		<?php
		}
		?>
	</div>
</div>
<script type="text/javascript">
	function paymentClicked() {
		if (document.getElementById("confirm").checked == false) {
			alert("Please confirm and then proceed to pay.");
			return;
		}
		document.getElementById("payment_form").submit();
	}
</script>
@endsection