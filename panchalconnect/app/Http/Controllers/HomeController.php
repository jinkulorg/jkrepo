<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
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
