<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Profile;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storePaymentDetails($params) {
        $payment = new Payment();
      
        $payment->PROFILE_ID = Auth()->User()->Profile->id;
        $payment->ORDERID = (array_key_exists('ORDERID', $params)) ? $params['ORDERID'] : null;
        $payment->MID = (array_key_exists('MID', $params)) ? $params['MID'] : null;
        $payment->TXNID = (array_key_exists('TXNID', $params)) ? $params['TXNID'] : null;
        $payment->TXNAMOUNT = (array_key_exists('TXNAMOUNT', $params)) ? $params['TXNAMOUNT'] : null;
        $payment->PAYMENTMODE = (array_key_exists('PAYMENTMODE', $params)) ? $params['PAYMENTMODE'] : null;
        $payment->CURRENCY = (array_key_exists('CURRENCY', $params)) ? $params['CURRENCY'] : null;
        $payment->TXNDATE = (array_key_exists('TXNDATE', $params)) ? $params['TXNDATE'] : null;
        $payment->STATUS = (array_key_exists('STATUS', $params)) ? $params['STATUS'] : null;
        $payment->RESPCODE = (array_key_exists('RESPCODE', $params)) ? $params['RESPCODE'] : null;
        $payment->RESPMSG = (array_key_exists('RESPMSG', $params)) ? $params['RESPMSG'] : null;
        $payment->GATEWAYNAME = (array_key_exists('GATEWAYNAME', $params)) ? $params['GATEWAYNAME'] : null;
        $payment->BANKTXNID = (array_key_exists('BANKTXNID', $params)) ? $params['BANKTXNID'] : null;
        $payment->BANKNAME = (array_key_exists('BANKNAME', $params)) ? $params['BANKNAME'] : null;
        $payment->CHECKSUMHASH = (array_key_exists('CHECKSUMHASH', $params)) ? $params['CHECKSUMHASH'] : null;
        $payment->SOURCE = 'P';

        if ((array_key_exists('STATUS', $params)) && $params['STATUS'] == "TXN_SUCCESS") {
            $payment->START_DATE = date("Y/m/d");
            $payment->END_DATE = date('Y/m/d', strtotime("+12 months", strtotime(date("Y/m/d"))));
        } else {
            $payment->START_DATE = date("Y/m/d");
            $payment->END_DATE = date("Y/m/d");
        }

        $payment->save();
        
        return true;
    }

    public function isPaymentReceived($id) {
        $profile = Profile::find($id);
        if ($profile == null) {
            return false;
        }

        $activePayments = $profile->Payment->where('END_DATE','>=',date('Y/m/d'))->where('START_DATE','<=',date('Y/m/d'));

        $isSuccess = false;
        foreach($activePayments as $payment) {
            if ($payment->STATUS == "TXN_SUCCESS") {
                $isSuccess = true;
                break;
            }
        }
        return $isSuccess;
    }
}
