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

            echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";

            $params = [];
            if (isset($_POST) && count($_POST) > 0) {
                foreach ($_POST as $paramName => $paramValue) {
                    $params[$paramName] = $paramValue;
                }
                $params['SOURCE'] = "FP";
                $paymentController = new App\Http\Controllers\PaymentController();
                $paymentController->storePaymentDetails($params);
            }

            if ((array_key_exists('STATUS', $_POST)) && $_POST["STATUS"] == "TXN_SUCCESS") {
                echo "<b>Panchal Connect transaction status is success</b>" . "<br/>";
                $featuredProfileController = new App\Http\Controllers\FeaturedProfileController();
                $plan = null;
                if ((array_key_exists('TXNAMOUNT', $params))) {
                    if ($params['TXNAMOUNT'] == 100) {
                        $plan = "plan1";
                    } else if ($params['TXNAMOUNT'] == 500) {
                        $plan = "plan2";
                    } else if ($params['TXNAMOUNT'] == 1000) {
                        $plan = "plan3";
                    }
                }
                $isSuccess = $featuredProfileController->storeFeaturedProfile($plan);

                if ($isSuccess) {
                    ?>
                    <div class="alert alert-success">
                        <?php echo "Your profile is promoted succesfully."; ?>
                        <br><br>
                    </div>
                <?php
                        } else {
                            ?>
                    <div class="alert alert-success">
                        <?php echo "Your profile is not promoted succesfully. Please contact administrator"; ?>
                        <br><br>
                    </div>
                <?php
                }
                //Process your transaction here as success transaction.
                //Verify amount & order id received from Payment gateway with your application's order id and amount.
            } else {
                echo "<b>Transaction status is failure</b>" . "<br/>";
                if ((array_key_exists('RESPMSG', $_POST))) {
                    echo $_POST['RESPMSG'] . "<br>";
                }
            }
        } else {
            echo "<b>Checksum mismatched.</b>";
            //Process transaction as suspicious.
        }

        ?>


    </div>
    @endsection