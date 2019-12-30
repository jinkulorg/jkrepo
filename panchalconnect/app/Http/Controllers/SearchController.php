<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function basicSearch(Request $request)
    {
        $ageGreaterThan = $request->get('ageGreaterThan');
        $ageLessThan = $request->get('ageLessThan');

        $filteredProfiles = Profile::search([
            'gender' => $request->get('gender'),
            'present_state' => $request->get('present_state'),
            'hobby' => $request->get('hobby'),
            'marital_status' => $request->get('marital_status')
        ])->get();

        return view('search_result', compact('filteredProfiles', 'ageGreaterThan', 'ageLessThan'));
    }
}
