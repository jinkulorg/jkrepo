<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Profile;
use \App\FeaturedProfile;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin() {
        $totalUsers = User::all()->count();
        $totalInactiveProfiles = Profile::where('STATUS','=','INACTIVE')->get()->count();
        $totalActiveProfiles = Profile::where('STATUS','=','ACTIVE')->get()->count();
        $totalMarried = Profile::where('STATUS','=','MARRIED')->get()->count();
        
        return view('admin.dashboard',compact('totalUsers','totalInactiveProfiles','totalActiveProfiles','totalMarried'));
    }

    public function manageUser() {
        $users = User::all();
        return view('admin.manage_user', compact('users'));
    }

    public function manageProfile() {
        $profiles = Profile::all();
        return view('admin.manage_profile', compact('profiles'));
    }

    public function manageFeaturedProfile() {
        $featuredprofiles = FeaturedProfile::all();
        return view('admin.manage_featured_profile', compact('featuredprofiles'));
    }

    public function editUser($id) { 
        $user = User::find($id);
        return view('admin.edituser',compact('user','id'));
    }

    public function updateUser(Request $request, $id) {
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->type = $request->get('type');
        $user->save();
        return redirect()->route('manageuser')->with('success','User ' . $id . ' updated successfully.');

    }

    public function destroyUser($id) {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('manageuser')->with('success','User ' . $id . ' deleted successfully.');
    }

    public function destroyProfile($id) {
        $profile = Profile::find($id);
        $profile->delete();
        return redirect()->route('manageprofile')->with('success','Profile ' . $id . ' deleted successfully.');
    }

    public function activate($id) {
        $this->changeProfileStatus($id, "ACTIVE");
        return redirect()->route('manageprofile')->with('success','Profile ' . $id . ' is now Active.');
    }

    public function inactivate($id) {
        $this->changeProfileStatus($id, "INACTIVE");
        return redirect()->route('manageprofile')->with('success','Profile ' . $id . ' is now In-Active.');
    }

    public function changeProfileStatus($profileid, $status) {
        $profile = Profile::find($profileid);
        $profile->status = $status;
        $profile->save();
    }

    public function approveFeaturedProfile($featuredProfileId) {
        $featuredProfile = FeaturedProfile::find($featuredProfileId);
        $featuredProfile->status = "APPROVED";
        $featuredProfile->start_date = date("Y/m/d");
        $plan = $featuredProfile->plan;
        if ($plan == "plan1") {
            $enddate = date('Y/m/d', strtotime("+1 months", strtotime(date("Y/m/d"))));
        } else if ($plan == "plan2") {
            $enddate = date('Y/m/d', strtotime("+6 months", strtotime(date("Y/m/d"))));
        } else if ($plan == "plan3") {
            $enddate = date('Y/m/d', strtotime("+12 months", strtotime(date("Y/m/d"))));
        } else {
            $enddate = date("Y/m/d");
        }
        $featuredProfile->end_date = $enddate;
        $featuredProfile->save();

        $profile_id = $featuredProfile->profile_id;
        return redirect()->route('managefeaturedprofile')->with('success','Featured Profile ' . $featuredProfileId . ' is now Approved for profile id, ' . $profile_id . '.');
    }

    public function rejectFeaturedProfile($featuredProfileId) {
        $profile_id = $this->changeFeaturedProfileStatus($featuredProfileId, "REJECTED");
        return redirect()->route('managefeaturedprofile')->with('success','Featured Profile ' . $featuredProfileId . ' is now Rejected for profile id, ' . $profile_id . '.');
    }

    
    public function destroyFeaturedProfile($featuredProfileId) {
        $featuredprofile = FeaturedProfile::find($featuredProfileId);
        $profile_id = $featuredprofile->profile_id;
        $featuredprofile->delete();
        return redirect()->route('managefeaturedprofile')->with('success','Featured Profile ' . $featuredProfileId . '  for profile id, ' . $profile_id . ' deleted successfully.');
    }

    public function changeFeaturedProfileStatus($featuredProfileId, $status) {
        $featuredProfile = FeaturedProfile::find($featuredProfileId);
        $featuredProfile->status = $status;
        $featuredProfile->save();
        return $featuredProfile->profile_id;
    }
}
