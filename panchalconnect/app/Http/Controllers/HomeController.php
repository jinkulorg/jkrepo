<?php

namespace App\Http\Controllers;

use App\FeaturedProfile;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /**
         * Commenting this line because when this is present then on opening home page needs user to be login first. 
         * So, this prevents guest from viewing the home page.
         */
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $expiredProfiles = FeaturedProfile::where('end_date','<=',date("Y/m/d"))->get();
        foreach($expiredProfiles as $expiredProfile) {
            $expiredProfile->status = "EXPIRED";
            $expiredProfile->save();
        }
        $featuredProfiles = FeaturedProfile::where('status','=','APPROVED')->orderBy('created_at','desc')->get();

        $allStates = DB::table('profiles')
            ->select('present_state')
            ->where('present_state','!=',null)
            ->groupBy('present_state')
            ->get();

        $allHobbies = DB::table('profiles')
            ->select('hobby')
            ->where('hobby','!=',null)
            ->groupBy('hobby')
            ->get();

        return view('index',compact('featuredProfiles','allStates','allHobbies'));
    }

    public function mail(Request $request) {
        
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $msg = $request->input('message');

        Mail::to('kuldeepjinkal@panchalconnect.com')->send(new SendMailable($name, $phone, $email, $msg));
        return redirect()->route('contact')->with('success','Email sent successfully');
    }
}
