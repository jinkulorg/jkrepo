<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;

header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
// require_once("./lib/config_paytm.php");
// require_once("./lib/encdec_paytm.php");
@include("/config/config_paytm.php");
@include("/config/encdec_paytm.php");
?>
@extends('layouts.app')

@section('content')
<div class="grid_3">
	<div class="container">
		<div class="breadcrumb1">
			<ul>
				<a href="/"><i class="fa fa-home home_1"></i></a>
				<span class="divider">&nbsp;|&nbsp;</span>
				<li class="current-page">Activate Account</li>
			</ul>
		</div>

		<?php
		$paytmChecksum = "";
		$paramList = array();
		$isValidChecksum = "FALSE";

		$paramList = $_POST;
		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

		//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
		$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


		if ($isValidChecksum == "TRUE") {

			// echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";

			if (isset($_POST) && count($_POST) > 0) {
				$params = [];
				foreach ($_POST as $paramName => $paramValue) {
					$params[$paramName] = $paramValue;
				}
				$params['SOURCE'] = "P";
				$paymentController = new App\Http\Controllers\PaymentController();
				$txnid = $params['TXNID'];
				$samepayments = App\Payment::all()->where('TXNID','=',$txnid);
				if ($samepayments == null || sizeof($samepayments) == 0) {
					$paymentController->storePaymentDetails($params);
				}
			}

			if ((array_key_exists('STATUS', $_POST)) && $_POST["STATUS"] == "TXN_SUCCESS") {
				?>
                	<?php
						$profileController = new App\Http\Controllers\ProfilesController();
						$isActive = $profileController->gotPaymentAndActivateProfile(Auth::User()->profile->id);
				
						if ($isActive) {
							$paymentController = new App\Http\Controllers\PaymentController();
							$paymentDetails = $paymentController->getPaymentDetailsForActivateProfile();
							?>
								@if($paymentDetails != null)
								 <div class="alert alert-success">
									<h3><b><i class='fa fa-check' aria-hidden='true'></i> Congratulations!! Transaction is successful. Thank you for registering with us!</b> <br><br>
										We have received your payment. Your Panchal Connect profile is now Active. <a href="{{action('ProfilesController@show',Auth::User()->profile->id)}}">Click here</a> to view your profile status.</h3><br><br>
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
							echo "Your profile is still not Active. It seems that you have not created profile. Please contact us with all the payment transaction details.";
						}
                	?>
				<?php
				
				//Process your transaction here as success transaction.
				//Verify amount & order id received from Payment gateway with your application's order id and amount.
			} else {
				?>
        			<div class="alert alert-danger">
        			    <ul>
        			        <li>
								<b><i class='fa fa-times' aria-hidden='true'></i> Transaction is failed. We apologize for inconvenience caused to you. Please try again later.</b><br><br>
								<b>Message from Paytm:</b><br>
								<?php
								if ((array_key_exists('RESPMSG', $_POST))) {
                    				echo $_POST['RESPMSG'] . "<br>";
								}
								?>
							</li>
        			    </ul>
        			</div>
				<?php
			}
			
		} else {
			?>
        		<div class="alert alert-danger">
        			<ul>
        			    <li>
							<b><b><i class='fa fa-times' aria-hidden='true'></i> Transaction is failed. We apologize for inconvenience caused to you. Please try again later.</b><br><br>
							<?php
								echo "Reason: <b>Checksum mismatched.</b>";
							?>
						</li>
        			</ul>
        		</div>
			<?php
			
			//Process transaction as suspicious.
		}

		?>


</div>
@endsection