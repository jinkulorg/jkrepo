<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reference;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $references = null;
        if ((Auth()->user() != null && Auth()->user()->Profile != null)) {
            $references = Reference::where('profile_id',Auth()->User()->Profile->id)->get()->toArray();
        }
        return view('references.view',compact('references'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('references.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reference = new Reference([
            'profile_id' => Auth()->User()->Profile->id,
            'first_name' => $request->get('first_name'),
            'second_name' => $request->get('second_name'),
            'last_name' => $request->get('last_name'),
            'relation' => $request->get('relation'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'pincode' => $request->get('pincode'),
            'code' => $this->generateCode($request->get('first_name'),$request->get('last_name'),$request->get('city'))
        ]);
        $reference->save();
        return redirect()->route('reference.index')->with('success','Reference added');
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
        $reference = Reference::find($id);
        return view('references.edit',compact('reference','id'));
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
        $reference = Reference::find($id);

        $reference->first_name = $request->get('first_name');
        $reference->second_name = $request->get('second_name');
        $reference->last_name = $request->get('last_name');
        $reference->relation = $request->get('relation');
        $reference->city = $request->get('city');
        $reference->state = $request->get('state');
        $reference->pincode = $request->get('pincode');
        $reference->code = $this->generateCode($request->get('first_name'),$request->get('last_name'),$request->get('city'));

        $reference->save();
        return redirect()->route('reference.index')->with('success','Reference Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reference = Reference::find($id);
        $reference->delete();
        return redirect()->route('reference.index')->with('success','Reference Deleted');
    }

    public function generateCode(String $firstname, String $lastname, String $city) {
        $firstnamechar = "";
        $lastnamechar = "";
        
        if (strlen($firstname) < 4) {
            $firstnamechar = $firstname;
        } else {
            $firstnamechar = substr($firstname,0,4);
        }

        if (strlen($lastname) < 4) {
            $lastnamechar = $lastname;
        } else {
            $lastnamechar = substr($lastname,0,4);
        }

        return strtoupper($firstnamechar . $lastnamechar . $city);
    }
}
