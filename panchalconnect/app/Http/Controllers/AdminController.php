<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Reference;
use App\FeaturedProfile;
use App\Married;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin() {
        $totalUsers = User::all()->count();
        $totalProfiles = Profile::all()->count();
        $totalInactiveProfiles = Profile::where('STATUS','=','INACTIVE')->get()->count();
        $totalActiveProfiles = Profile::where('STATUS','=','ACTIVE')->get()->count();
        $totalMarried = Profile::where('STATUS','=','MARRIED')->get()->count();
        $totalAmountReceived = DB::table('payments')->where('STATUS','=','TXN_SUCCESS')->sum('TXNAMOUNT');
        $totalAmountReceivedForActivation = DB::table('payments')->where('STATUS','=','TXN_SUCCESS')->where('SOURCE','=','P')->sum('TXNAMOUNT');
        $totalAmountReceivedForPromotion = DB::table('payments')->where('STATUS','=','TXN_SUCCESS')->where('SOURCE','=','FP')->sum('TXNAMOUNT');
        
        return view('admin.dashboard',compact('totalUsers','totalInactiveProfiles','totalProfiles','totalActiveProfiles','totalMarried','totalAmountReceived','totalAmountReceivedForActivation','totalAmountReceivedForPromotion'));
    }

    public function manageUser() {
        $users = User::paginate(20);
        return view('admin.manage_user', compact('users'));
    }

    public function manageProfile() {
        $profiles = Profile::paginate(20);
        return view('admin.manage_profile', compact('profiles'));
    }

    public function manageFeaturedProfile() {
        $featuredprofiles = FeaturedProfile::paginate(20);
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
        if ($profile == null) {
            return back()->with('failure','Profile is already deleted');
        }

        $requestSents = $profile->request_sent;
        foreach($requestSents as $requestSent) {
            $requestSent->request_received->delete();
            $requestSent->delete();
        }

        $requestReceiveds = $profile->request_received;
        foreach($requestReceiveds as $requestReceived) {
            $requestReceived->request_sent->delete();
            $requestReceived->delete();
        }

        Reference::where('profile_id','=',$id)->delete();

        FeaturedProfile::where('profile_id','=',$id)->delete();

        Married::where('profile_id','=',$id)->delete();

        $paymentController = new PaymentController();
        $payment = $paymentController->getPaymentDetailsForActivateProfileFor($id);
        $payment->END_DATE = date("Y/m/d");
        $payment->save();

        $payment = $paymentController->getPaymentDetailsForPromoteProfileFor($id);
        $payment->END_DATE = date("Y/m/d");
        $payment->save();

        $profileController = new ProfilesController();
        $profileController->removeOldProfilePics($profile->profile_pic_path);

        $profile->delete();

        return redirect()->route('manageprofile')->with('success','Profile ' . $id . ' deleted successfully.');
    }

    public function activate($id) {
        $this->changeProfileStatus($id, "ACTIVE");
        return redirect()->route('manageprofile')->with('success','Profile ' . $id . ' is now Active.');
    }

    public function inactivate($id) {
        $this->changeProfileStatus($id, "INACTIVE");

        $paymentController = new PaymentController();
        $payment = $paymentController->getPaymentDetailsForActivateProfileFor($id);
        $payment->END_DATE = date('Y/m/d', strtotime("-1 days", strtotime(date("Y/m/d"))));
        $payment->save();

        return redirect()->route('manageprofile')->with('success','Profile ' . $id . ' is now In-Active.');
    }

    public function changeProfileStatus($profileid, $status) {
        $profile = Profile::find($profileid);
        $profile->status = $status;
        $profile->save();
    }

    // public function approveFeaturedProfile($featuredProfileId) {
    //     $featuredProfile = FeaturedProfile::find($featuredProfileId);
    //     $featuredProfile->status = "APPROVED";
    //     $featuredProfile->start_date = date("Y/m/d");
    //     $plan = $featuredProfile->plan;
    //     if ($plan == "plan1") {
    //         $enddate = date('Y/m/d', strtotime("+1 months", strtotime(date("Y/m/d"))));
    //     } else if ($plan == "plan2") {
    //         $enddate = date('Y/m/d', strtotime("+6 months", strtotime(date("Y/m/d"))));
    //     } else if ($plan == "plan3") {
    //         $enddate = date('Y/m/d', strtotime("+12 months", strtotime(date("Y/m/d"))));
    //     } else {
    //         $enddate = date("Y/m/d");
    //     }
    //     $featuredProfile->end_date = $enddate;
    //     $featuredProfile->save();

    //     $profile_id = $featuredProfile->profile_id;
    //     return redirect()->route('managefeaturedprofile')->with('success','Featured Profile ' . $featuredProfileId . ' is now Approved for profile id, ' . $profile_id . '.');
    // }

    // public function rejectFeaturedProfile($featuredProfileId) {
    //     $profile_id = $this->changeFeaturedProfileStatus($featuredProfileId, "REJECTED");
    //     return redirect()->route('managefeaturedprofile')->with('success','Featured Profile ' . $featuredProfileId . ' is now Rejected for profile id, ' . $profile_id . '.');
    // }

    
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

    public function getUser(Request $request) {
        $userid = $request->get('userid');
        if ($userid == "") {
            return back()->with('failure', 'Enter User ID');
        }
        $user = User::find($userid);
        if ($user == null) {
            return back()->with('failure', 'User not found');
        }
        $users[0] = $user;
        return view('admin.manage_user', compact('users'));
    }

    public function getProfile(Request $request) {
        $profileid = $request->get('profileid');
        if ($profileid == "") {
            return back()->with('failure', 'Enter Profile ID');
        }

        $profile = Profile::find($profileid);
        if ($profile == null) {
            return back()->with('failure', 'Profile not found');
        }
        $profiles[0] = $profile;
        return view('admin.manage_profile', compact('profiles'));
    }
}
