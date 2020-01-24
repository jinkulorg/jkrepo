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
        return view('view_profile', compact('profile','isSent','isGuest','isSelf','noProfile','isReceived'));;
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

        $input = Input::get('Interested');
        if (isset($input)) {
            $request->status = "INTERESTED";
            $msg = "You have successfully shown interest in " . $user->name . " " . $user->lastname . " profile" ;
        }

        $input = Input::get('Not_Interested');
        if (isset($input)) {
            $request->status = "NOT INTERESTED";
            $msg = "You have successfully shown not interested in " . $user->name . " " . $user->lastname . " profile" ;
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
        return redirect()->back()->with('success','Request unsent successfully ');
    }
}
