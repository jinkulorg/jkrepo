<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function openAdvancedSearch()
    {
        $allStates = DB::table('profiles')
            ->select('present_country', 'present_state')
            ->where('present_state', '!=', null)
            ->groupBy('present_country', 'present_state')
            ->get();

        $allHobbies = DB::table('profiles')
            ->select('hobby')
            ->where('hobby', '!=', null)
            ->groupBy('hobby')
            ->get();

        $educations = DB::table('profiles')
            ->select('education')
            ->where('education', '!=', null)
            ->groupBy('education')
            ->get();

        $occupations = DB::table('profiles')
            ->select('occupation')
            ->where('occupation', '!=', null)
            ->groupBy('occupation')
            ->get();

        $designations = DB::table('profiles')
            ->select('designation')
            ->where('designation', '!=', null)
            ->groupBy('designation')
            ->get();

        return view('advanced_search', compact('allStates', 'allHobbies', 'educations', 'occupations', 'designations'));
    }

    public function openReferenceSearch() {
        $references = Reference::where('profile_id',Auth()->User()->Profile->id)->get()->toArray();
        return view('reference_search',compact('references'));
    }

    public function referenceSearch() {
        $loggedInProfileId = Auth()->User()->Profile->id;
        $references = Reference::where('profile_id',$loggedInProfileId)->get();
        $filteredProfiles = [];

        foreach($references as $reference) {
            $code = $reference->code;
            $mutualReferences = Reference::where('code',$code)->where('profile_id','!=',$loggedInProfileId)->get();
            
            foreach($mutualReferences as $mutualReference) {
                $profile = Profile::find($mutualReference->profile_id);
               
                if ($profile != null) {
                    $filteredProfiles[$reference->id] = $profile;
                }
            }
        }
        return view('reference_search_result',compact('filteredProfiles'));
    }

    public function basicSearch(Request $request)
    {
        $ageGreaterThan = $request->get('ageGreaterThan');
        $ageLessThan = $request->get('ageLessThan');

        $preFilteredProfiles = Profile::search([
            'gender' => $request->get('gender'),
            'present_state' => $request->get('present_state'),
            'hobby' => $request->get('hobby'),
            'marital_status' => $request->get('marital_status')
        ], [])->get();

        $filteredProfiles = $this->getAgeFilteredProfiles($preFilteredProfiles, $ageGreaterThan, $ageLessThan);

        return view('search_result', compact('filteredProfiles'));
    }

    public function advancedSearch(Request $request)
    {
        $ageGreaterThan = $request->get('ageGreaterThan');
        $ageLessThan = $request->get('ageLessThan');

        $marital_status = [];
        if ($request->has('any') == false) {
            if ($request->has('never_married') == true) {
                array_push($marital_status, 'never married');
            }
            if ($request->has('divorced') == true) {
                array_push($marital_status, 'divorced');
            }
            if ($request->has('widowed') == true) {
                array_push($marital_status, 'widowed');
            }
            if ($request->has('annulled') == true) {
                array_push($marital_status, 'annulled');
            }
        }

        $shani = null;
        $mangal = null;
        if ($request->has('noshanimangal') == false) {
            if ($request->has('shani') == true) {
                $shani = '1';
            }
            if ($request->has('mangal') == true) {
                $mangal = '1';
            }
        } else {
            $shani = '0';
            $mangal = '0';
        }


        $preFilteredProfiles = Profile::search([
            'gender' => $request->get('gender'),
            'present_state' => $request->get('present_state'),
            'hobby' => $request->get('hobby'),
            'shani' => $shani,
            'mangal' => $mangal,
            'education' => $request->get('education'),
            'occupation' => $request->get('occupation'),
            'designation' => $request->get('designation')
        ], ['marital_status' => $marital_status])->get();

        
        $ageFilteredProfiles = $this->getAgeFilteredProfiles($preFilteredProfiles, $ageGreaterThan, $ageLessThan);

        $sign = $request->get('sign');
        $amountfrom = $request->get('amountfrom');
        $amountto = $request->get('amountto');

        $filteredProfiles = $this->getIncomeFilteredProfiles($ageFilteredProfiles, $sign, $amountfrom, $amountto);

        return view('search_result', compact('filteredProfiles'));
    }

    public function getAgeFilteredProfiles($preFilteredProfiles, $ageGreaterThan, $ageLessThan)
    {
        if (!(ctype_digit($ageGreaterThan) AND ctype_digit($ageLessThan))) {
            return $preFilteredProfiles;
        }

        $ageFilteredProfiles = array();
        foreach ($preFilteredProfiles as $profile) {
            if ($ageGreaterThan != null and $ageLessThan != null) {
                $age = $profile->age();
                if (!($age >= $ageGreaterThan and $age <= $ageLessThan)) {
                    continue;
                } else {
                    array_push($ageFilteredProfiles, $profile);
                }
            } else {
                $ageFilteredProfiles = $preFilteredProfiles;
            }
        }
        return $ageFilteredProfiles;
    }

    public function getIncomeFilteredProfiles($preFilteredProfiles, $sign, $amountfrom, $amountto)
    {
        if (!(ctype_digit($amountfrom))) {
            return $preFilteredProfiles;
        }

        if ($sign == "Range" AND !ctype_digit($amountto)) {
            return $preFilteredProfiles;
        }

        $incomeFilteredProfiles = array();
        foreach ($preFilteredProfiles as $profile) {

            if ($sign == "Range") {
                if (!($profile->annual_income >= $amountfrom and $profile->annual_income <= $amountto)) {
                    continue;
                } else {
                    array_push($incomeFilteredProfiles, $profile);
                }
            } else if ($sign == "=") {
                if (!($profile->annual_income == $amountfrom)) {
                    continue;
                } else {
                    array_push($incomeFilteredProfiles, $profile);
                }
            } else if ($sign == ">") {
                if (!($profile->annual_income > $amountfrom)) {
                    continue;
                } else {
                    array_push($incomeFilteredProfiles, $profile);
                }
            } else if ($sign == "<") {
                if (!($profile->annual_income < $amountfrom)) {
                    continue;
                } else {
                    array_push($incomeFilteredProfiles, $profile);
                }
            } else {
                $incomeFilteredProfiles = $preFilteredProfiles;
                break;
            }
        }
        return $incomeFilteredProfiles;
    }
}
