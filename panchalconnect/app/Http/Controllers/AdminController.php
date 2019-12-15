<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Profile;

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
}
