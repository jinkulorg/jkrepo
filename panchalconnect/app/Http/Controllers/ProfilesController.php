<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profile = new Profile;

        $profile->profile_pic_path     =     $request->input('profile_pic_path');
        $profile->user_id              =     Auth()->user()->id;
        $profile->gender               =     $request->input('gender');
        $profile->physical_status      =     $request->input('physical_status');
        $profile->height               =     $request->input('height');
        $profile->weight               =     $request->input('weight');
        $profile->hobby                =     $request->input('hobby');
        $profile->complexion           =     $request->input('complexion');
        $profile->specs                =     ($request->input('specs') == "YES") ? true : false;
        $profile->vegetarion           =     ($request->input('vegetarion') == "YES") ? true : false;
        $profile->non_vegetarion       =     ($request->input('non_vegetarion') == "YES") ? true : false;
        $profile->eggetarion           =     ($request->input('eggetarion') == "YES") ?  true: false;
        $profile->drink                =     ($request->input('drink') == "YES") ? true : false;
        $profile->smoke                =     ($request->input('smoke') == "YES") ? true :false;
        $profile->self_description     =     $request->input('self_description');
        $profile->profile_created_by   =     $request->input('profile_created_by');
        $profile->subcast              =     $request->input('subcast');
        $profile->birth_date           =     $request->input('birth_date');
        $profile->birth_time           =     $request->input('birth_time');
        $profile->birth_place          =     $request->input('birth_place');
        $profile->native               =     $request->input('native');
        $profile->marital_status       =     $request->input('marital_status');
        $profile->rashi                =     $request->input('rashi');
        $profile->mangal               =     ($request->input('mangal') == "YES") ? true :false;
        $profile->shani                =     ($request->input('shani') == "YES") ? true : false;
        $profile->highest_education    =     $request->input('highest_education');
        $profile->education_details    =     $request->input('education_details');
        $profile->occupation           =     $request->input('occupation');
        $profile->area_of_business     =     $request->input('area_of_business');
        $profile->designation          =     $request->input('designation');
        $profile->company_name         =     $request->input('company_name');
        $profile->annual_income        =     $request->input('annual_income');
        $profile->contact_no           =     $request->input('contact_no');
        $profile->present_address      =     $request->input('present_address');
        $profile->present_city         =     $request->input('present_city');
        $profile->present_taluka       =     $request->input('present_taluka');
        $profile->present_district     =     $request->input('present_district');
        $profile->present_state        =     $request->input('present_state');
        $profile->present_country      =     $request->input('present_country');
        $profile->present_pincode      =     $request->input('present_pincode');
        $profile->permanent_address    =     $request->input('permanent_address');
        $profile->permanent_city       =     $request->input('permanent_city');
        $profile->permanent_taluka     =     $request->input('permanent_taluka');
        $profile->permanent_district   =     $request->input('permanent_district');
        $profile->permanent_state      =     $request->input('permanent_state');
        $profile->permanent_country    =     $request->input('permanent_country');
        $profile->permanent_pincode    =     $request->input('permanent_pincode');
        $profile->father_name          =     $request->input('father_name');
        $profile->father_occupation    =     $request->input('father_occupation');
        $profile->father_annual_income =     $request->input('father_annual_income');
        $profile->father_contact_no    =     $request->input('father_contact_no');
        $profile->mother_name          =     $request->input('mother_name');
        $profile->mother_occupation    =     $request->input('mother_occupation');
        $profile->mother_annual_income =     $request->input('mother_annual_income');
        $profile->mother_contact_no    =     $request->input('mother_contact_no');
        $profile->no_of_brothers       =     $request->input('no_of_brothers');
        $profile->no_of_sisters        =     $request->input('no_of_sisters');
        $profile->status               =     "INACTIVE";
       
        $profile->save();
        
        return view("index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::find($id);
        if ($profile == false) {
            return "No profile for id: " . $id;

        } else {
            $profileid = User::find(Auth()->User()->id)->Profile->id;
            $requestsents = Profile::find($profileid)->Request_sent;
            $isSent = false;
            foreach($requestsents as $requestsent) {
                $profileidreceived = $requestsent->Request_received->profile_id;
                if ($profileidreceived == $id) {
                    $isSent = true;
                    return view('view_profile', compact('profile','isSent'));
                }
            }
            return view('view_profile', compact('profile','isSent'));
        }
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
}
