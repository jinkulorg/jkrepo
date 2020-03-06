<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AffiliateController extends Controller
{
    public function index() {

        $referredUsers = null;
        $loginuser = Auth()->User();
        if ($loginuser != null) {
            $referredUsers = User::all()->where('referred_by','=',$loginuser->id);
        }

        return view('affiliate',compact('referredUsers'));
    }
}
