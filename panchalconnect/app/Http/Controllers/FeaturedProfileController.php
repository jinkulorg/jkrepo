<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeaturedProfile;

class FeaturedProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('featured_profile');
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
        $plan = $request->input('plan');
        if ($plan == "plan1") {
            $enddate = date('Y/m/d', strtotime("+1 months", strtotime(date("Y/m/d"))));
        } else if ($plan == "plan2") {
            $enddate = date('Y/m/d', strtotime("+6 months", strtotime(date("Y/m/d"))));
        } else if ($plan == "plan3") {
            $enddate = date('Y/m/d', strtotime("+12 months", strtotime(date("Y/m/d"))));
        } else {
            $enddate = date("Y/m/d");
        }

        $featuredProfile = new FeaturedProfile([
            'profile_id' => Auth()->User()->Profile->id,
            'plan' => $plan,
            'start_date' => date("Y/m/d"),
            'end_date' => $enddate,
            'status' => "REQUESTED",
        ]);
        $featuredProfile->save();

        return redirect()->route('featuredprofile.index')->with('success', 'Your request to promote profile is submitted succesfully.');
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
}
