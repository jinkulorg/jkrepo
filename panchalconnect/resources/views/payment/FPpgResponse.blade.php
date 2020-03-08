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

            $params = [];
            if (isset($_POST) && count($_POST) > 0) {
                foreach ($_POST as $paramName => $paramValue) {
                    $params[$paramName] = $paramValue;
                }
                $params['SOURCE'] = "FP";
                $paymentController = new App\Http\Controllers\PaymentController();

                if ((array_key_exists('TXNID', $_POST))) {
                    $txnid = $params['TXNID'];
                    $samepayments = App\Payment::all()->where('TXNID','=',$txnid);
                    if ($samepayments == null || sizeof($samepayments) == 0) {
                        $paymentController->storePaymentDetails($params, Auth()->User()->Profile->id);
                    }
                }
            }

            if ((array_key_exists('STATUS', $_POST)) && $_POST["STATUS"] == "TXN_SUCCESS") {
                
                $featuredProfileController = new App\Http\Controllers\FeaturedProfileController();
                $planName = "";
                $plan = null;
                
                if ((array_key_exists('TXNAMOUNT', $params))) {
                    if ($params['TXNAMOUNT'] == PLAN1_AMOUNT) {
                        $plan = "plan1";
                        $planName = "SILVER";
                        $enddate = date('Y/m/d', strtotime("+1 months", strtotime(date("Y/m/d"))));
                    } else if ($params['TXNAMOUNT'] == PLAN2_AMOUNT) {
                        $plan = "plan2";
                        $planName = "GOLD";
                        $enddate = date('Y/m/d', strtotime("+6 months", strtotime(date("Y/m/d"))));
                    } else if ($params['TXNAMOUNT'] == PLAN3_AMOUNT) {
                        $plan = "plan3";
                        $planName = "PLATINUM";
                        $enddate = date('Y/m/d', strtotime("+12 months", strtotime(date("Y/m/d"))));
                    } else {
                        $enddate = date("Y/m/d");
                    }
                }
                $isSuccess = "true";
                if ($samepayments == null || sizeof($samepayments) == 0) {
                    $isSuccess = $featuredProfileController->storeFeaturedProfile($plan, Auth()->User()->Profile->id);
                }

                if ($isSuccess) {
				        ?>
				        	 <div class="alert alert-success">
				        		<h3><b><i class='fa fa-check' aria-hidden='true'></i> Transaction is successful. Thank you for promoting your profile!</b> <br><br>
				        			We have received your payment. Your profile is promoted succesfully for {{$planName}} plan and your profile is now visilbe on <a href="/">home</a> page under featured profiles.</h3><br><br>
				        		<div class="row">
				        			<div class="col-sm-2" style="line-height: 2em">
				        				<b>Status:</b><br>
				        				<b>Payment Id</b><br>
				        				<b>Amount Paid</b><br>
				        				<b>Validity:</b><br>
				        			</div>
				        			<div class="col-sm-4" style="line-height: 2em">
				        				PROMOTED<br>
				        				{{$params['ORDERID']}}<br>
				        				Rs. {{$params['TXNAMOUNT']}}/-<br>
				        				From {{date('d-M-Y', strtotime(date("Y/m/d")))}} to {{date('d-M-Y', strtotime($enddate))}}<br>
				        			</div>
                                </div>
                                <br>
                                We hope you will promote your profile again in future.
				        	</div>
				        <?php

                    } else {
                        echo "Your profile is not promoted succesfully. Please contact administrator"; 
                }
                
                //Process your transaction here as success transaction.
                //Verify amount & order id received from Payment gateway with your application's order id and amount.
            } else {?>
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