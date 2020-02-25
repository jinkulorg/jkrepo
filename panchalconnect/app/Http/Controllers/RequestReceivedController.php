<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Request_received;
use App\Profile;
use Illuminate\Support\Facades\Input;

class RequestReceivedController extends Controller
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
    public function store(Request $request,$requestsentid)
    {
        $request_received = new Request_received([
            'request_sent_id' => $requestsentid,
            'profile_id' => $request->get('profileid'),
            'status'=> 'NEW'
        ]);
        
        $request_received->save();
        $profile = Profile::find($request->get('profileid'));
        $isSent = true;
        $isGuest = false;
        $isSelf = false;
        $noProfile = false;
        $isReceived = false;
        $failuremsg = "";

        $homeController = new HomeController();
        $allHobbies = $homeController->getAllHobbies();

        $successmsg = "You have successfully sent interest to " . $request_received->profile->user->name . " " . $request_received->profile->user->lastname;

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
        $request = Request_received::find($id);
        $user = $request->Request_sent->profile->user;

        $input = Input::get('SenderMarried');
        if (isset($input)) {
            $with_profile_id = $request->profile_id;
            $user = $request->Profile->User;
            $with_person_name = $user->name . " " . $user->lastname;
            return view('married',compact('with_profile_id','with_person_name'));
        }

        $input = Input::get('ReceiverMarried');
        if (isset($input)) {
            $with_profile_id = $request->Request_sent->profile_id;
            $user = $request->Request_sent->Profile->User;
            $with_person_name = $user->name . " " . $user->lastname;
            return view('married',compact('with_profile_id','with_person_name'));
        }

        $input = Input::get('SenderMarriedNever');
        if (isset($input)) {
            $request->status = "NOT MARRY BY SENDER";
            $msg = "You decided not to marry " . $request->profile->user->name . " " . $request->profile->user->lastname;
        }

        $input = Input::get('ReceiverMarriedNever');
        if (isset($input)) {
            $request->status = "NOT MARRY BY RECEIVER";
            $msg = "You decided not to marry " . $user->name . " " . $user->lastname;
        }

        $input = Input::get('Interested');
        if (isset($input)) {
            $request->status = "INTERESTED";
            $msg = "You have successfully sent interest to " . $user->name . " " . $user->lastname;
        }

        $input = Input::get('Not_Interested');
        if (isset($input)) {
            $request->status = "NOT INTERESTED";
            $msg = "You have successfully sent not interested to " . $user->name . " " . $user->lastname;
        }

        $input = Input::get('NotMarried');
        if (isset($input)) {
            $request->status = "DISCONNECTED";
            //change status from both profiles

            $paymentController = new PaymentController();
            if ($paymentController->isPaymentReceivedFor($request->profile->id)) {
                $request->profile->status = "ACTIVE";
            } else {
                $request->profile->status = "INACTIVE";
            }
            $request->profile->save();
            
            if ($paymentController->isPaymentReceivedFor($user->profile->id)) {
                $user->profile->status = "ACTIVE";
            } else {
                $user->profile->status = "INACTIVE";
            }
            $user->profile->save();

            //remove marrieds table entry 
            $married = $request->profile->married;
            if ($married != null) {
                $married->delete();
            }

            $married = $user->profile->married;
            if ($married != null) {
                $married->delete();
            }

            $msg = "Your marriage is reverted back";
        }

        $request->save();

        

        return redirect()->route('requests.index')->with('success',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request_received = Request_received::find($id);
        $request_received->delete();
        $msg = "Request to " . $request_received->profile->user->name . " is unsent successfully";
        
        return redirect()->back()->with('success',$msg);
    }
}
