<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Request_sent;
use App\Profile;
class RequestSentController extends Controller
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
        $canSendAgain = $this->canRequestSentAgainTo($request->get('profileid'));

        if ($canSendAgain == false) {
            return back();
        }

        $request_sent = new Request_sent([
            'profile_id' => Auth()->User()->Profile->id
        ]);
        $request_sent->save();

        $requestReceivedController = new RequestReceivedController();
        $successmsg = $requestReceivedController->saveRequestReceived($request->get('profileid'), $request_sent->id);
        
        // return redirect()->action('RequestReceivedController@store',['request',$request,'requestsentid'=>$request_sent->id]);

        $profile = Profile::find($request->get('profileid'));
        $isSent = true;
        $isGuest = false;
        $isSelf = false;
        $noProfile = false;
        $isReceived = false;
        $failuremsg = "";

        $homeController = new HomeController();
        $allHobbies = $homeController->getAllHobbies();

        return view('view_profile', compact('profile','isSent','isGuest','isSelf','noProfile','isReceived','allHobbies','successmsg','failuremsg'));
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
        $request_sent = Request_sent::find($id);
        $request_received = $request_sent->Request_received;
        $request_sent->delete();
        return redirect()->action('RequestReceivedController@destroy',[$request_received->id]);
    }

    public function isRequestSentTo($toProfileId) {
        $requestsents = Auth()->User()->Profile->Request_sent;
                        
        foreach($requestsents as $requestsent) {
            $profileidreceived = $requestsent->Request_received->profile_id;
            if ($profileidreceived == $toProfileId && ($requestsent->Request_received->status == "NEW" || $requestsent->Request_received->status == "PENDING")) {
                return true;
            }
        }
        return false;
    }

    public function canRequestSentAgainTo($toProfileId) {
        $requestsents = Auth()->User()->Profile->Request_sent;
        $count = 0;     
        foreach($requestsents as $requestsent) {
            $profileidreceived = $requestsent->Request_received->profile_id;
            if ($profileidreceived == $toProfileId) {
                $count++;
            }
        }
        if ($count < MAX_REQUEST_SENT) {
            return true;
        } else {
            return false;
        }
    }

    public function isRequestSentApproved($toProfileId) {
        $requestsents = Auth()->User()->Profile->Request_sent;
                        
        foreach($requestsents as $requestsent) {
            $profileidreceived = $requestsent->Request_received->profile_id;
            if ($profileidreceived == $toProfileId && $requestsent->Request_received->status == "INTERESTED") {
                return true;
            }
        }
        return false;
    }

    public function isRequestReceivedFrom($fromProfileId) {
        $requestreceiveds = Auth()->User()->Profile->Request_received;
                        
        foreach($requestreceiveds as $requestreceived) {
            $profileidsent = $requestreceived->Request_sent->profile_id;
            if ($profileidsent == $fromProfileId  && ($requestreceived->status == "NEW" || $requestreceived->status == "PENDING")) {
                return true;
            }
        }
        return false;
    }

    public function isRequestReceivedApproved($fromProfileId) {
        $requestreceiveds = Auth()->User()->Profile->Request_received;
                        
        foreach($requestreceiveds as $requestreceived) {
            $profileidsent = $requestreceived->Request_sent->profile_id;
            if ($profileidsent == $fromProfileId  && $requestreceived->status == "INTERESTED") {
                return true;
            }
        }
        return false;
    }
}
