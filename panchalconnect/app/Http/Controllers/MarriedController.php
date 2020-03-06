<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Married;
use App\Profile;

class MarriedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $with_profile_id = null;
        return view('married', compact('with_profile_id'));
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
        $formated_date = date_format(date_create($request->get('marriage_date')), "Y/m/d");
        $profile_id = Auth()->User()->Profile->id;
        $with_profile_id = $request->get('with_profile_id');
        /**
         * Storing data in Marrieds table
         */
        $married = new Married([
            'profile_id' => $profile_id,
            'marriage_date' => $formated_date,
            'with_profile_id' => $request->get('with_profile_id'),
            'with_person_name' => $request->get('with_person_name'),
            'reference_useful' => $request->get('reference_useful'),
            'service_satisfied' => $request->get('service_satisfied'),
            'feedback' => $request->get('feedback'),
        ]);
        $married->save();

        /**
         * updating the status in the profile table
         */
        $profile = Profile::find($profile_id);
        $profile->status = "MARRIED";
        $profile->save();

        // if ($with_profile_id != null) {
        //     /**
        //      * Setting status in the Profile table for the person with whom the logged in person is married
        //      */
        //     $withProfile = Profile::find($with_profile_id);
        //     $withProfile->status = "MARRIED";
        //     $withProfile->save();

        //     /**
        //      * Setting status in the request_received table
        //      */
        //     $reqController = new RequestController();
        //     $result = $reqController->gotMarried($with_profile_id);
        //     $reqController = null;
        //     if ($result == true) {
        //         $success = 'You had successfully confirmed that you are married with ' . $withProfile->User->name . ' ' . $withProfile->User->lastname;
        //     } else {
        //         $success = 'Failed to update the status in Request data';
        //     }
        // } else {

        //     $success = 'You had successfully confirmed that you are married.';
        // }

        $success = 'You had successfully confirmed that you are married.';

        return view('married_confirmed', compact('success'));
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

    public function getMarriageStatus()
    {
        $profile = Auth()->user()->Profile;
        if ($this->isMarried($profile->id)) {
            $marriedWithProfile = null;
            $marriedData = $profile->Married;
            
            if ($marriedData == null) {
                $marriedData = Married::where('with_profile_id', '=', $profile->id)->first();
                $marriedWithProfile = Profile::find($marriedData->profile_id);
            } else {
                $marriedWithProfile = Profile::find($marriedData->with_profile_id);
            }

            if ($marriedWithProfile == null) {
                $marriedData = Married::where('profile_id', '=', $profile->id)->first();
                return "<h1>Congratulations!!!</h1><br><br> <h4>You are married with " . $marriedData->with_person_name . ".</h4> <br>" . $marriedData->with_person_name . " is not on panchal connect.";
            } else {
                return "<h1>Congratulations!!!</h1><br><br> <h4>You are married with " . $marriedWithProfile->User->name . " " . $marriedWithProfile->User->lastname . '</h4> <br>' . $marriedWithProfile->User->name . " " . $marriedWithProfile->User->lastname . " is on panchal connect, profile id is " . $marriedWithProfile->id . ".";
            }
        } else {
            return "<i class='fa fa-info-circle' aria-hidden='true'></i> You are not married yet.";
        }
    }

    public function isMarried($profileId)
    {
        $profile = Profile::find($profileId);
        return strtoupper($profile->status) == "MARRIED";
    }

    public function marriedPartnerOf($profileId) {
        $marriedWithProfile = null;
            $marriedData = Profile::find($profileId)->Married;
            
            if ($marriedData == null) {
                $marriedData = Married::where('with_profile_id', '=', $profileId)->first();
                $marriedWithProfile = Profile::find($marriedData->profile_id);
            } else {
                $marriedWithProfile = Profile::find($marriedData->with_profile_id);
            }

            if ($marriedWithProfile == null) {
                $marriedData = Married::where('profile_id', '=', $profileId)->first();
                return $marriedData->with_person_name;
            } else {
                return $marriedWithProfile->User->name . " " . $marriedWithProfile->User->lastname;
            }
    }
}
