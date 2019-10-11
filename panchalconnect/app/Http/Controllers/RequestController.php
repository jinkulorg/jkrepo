<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Request_sent;
use App\Request_received;
use App\Profile;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function index()
    {
        $requestSents = null;
        $requestReceiveds = null;
        $allRequests = null;
        
        $isLoggedIn = true;
        $isProfileCreated = true;
        
        $user = Auth()->User();
        if ($user == null) {
            $isLoggedIn = false;
            $isProfileCreated = false;
            return view('requests', compact('requestSents','requestReceiveds','allRequests','isLoggedIn','isProfileCreated'));
        }
        $profile = $user->Profile;
        if ($profile == null) {
            $isProfileCreated = false;
            return view('requests', compact('requestSents','requestReceiveds','allRequests','isLoggedIn','isProfileCreated'));
        }
        $requestSents = $profile->Request_sent->sortByDesc('created_at');
        $requestReceiveds = $profile->Request_received->sortByDesc('created_at');
        $allRequests = DB::table('request_sents')
                            ->join('request_receiveds', 'request_sents.id', '=', 'request_receiveds.request_sent_id')
                            ->select('request_sents.profile_id as profile_id_from', 'request_receiveds.*')
                            ->where('request_sents.profile_id','=',$profile->id)
                            ->orWhere('request_receiveds.profile_id','=',$profile->id)
                            ->orderBy('created_at','desc')
                            ->get();

        return view('requests', compact('requestSents','requestReceiveds','allRequests','isLoggedIn','isProfileCreated'));
    }
}
