<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Balance;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $balances = Balance::all()->toArray();
        return view('balances',compact('balances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('balancecreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'type'=>'required',
            'amount'=>'required',
        ]);
        $balance = new Balance([
            'name' => $request->get('name'),
            'type' => $request->get('type'),
            'amount' => $request->get('amount'),
        ]);
        $balance->save();
        return redirect()->route('balance.index')->with('success','Data added');
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
        $balance = Balance::find($id);
        return view('balanceedit',compact('balance','id'));
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
        $this->validate($request,[
            'name' => 'required',
            'type' => 'required',
            'amount' => 'required'
            ]);
        
        $balance = Balance::find($id);
        $balance->name = $request->get('name');
        $balance->type = $request->get('type');
        $balance->amount = $request->get('amount');
        $balance->save();
        
        return redirect()->route('balance.index')->with('success','Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $balance = Balance::find($id);
        $balance->delete();

        return redirect()->route('balance.index')->with('success','Data Deleted');
    }
}
