<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use Image; //Intervention Image
use Illuminate\Support\Facades\Storage; //Laravel Filesystem

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profile = new Profile;

        $profile_pic_path = $this->storeAndGetProfilePicPath($request);

        $this->saveProfileData($profile, $request, "INACTIVE", Auth()->user()->id, $profile_pic_path);
        
        $homeController = new HomeController();
        $featuredProfiles = $homeController->getFeaturedProfiles();
        $allStates = $homeController->getAllStates();
        $allHobbies = $homeController->getAllHobbies();

        return view('index',compact('featuredProfiles','allStates','allHobbies'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::find($id);
        if ($profile == false) {
            return "No profile for id: " . $id;

        } else {
            $isReceived = false;
            $isSent = false;
            $isGuest = false;
            $isSelf = false;
            $noProfile = false;
            $loginprofile = null;
            if ((Auth()->User()) == null) {
                $isGuest = true;
            } else {
                $loginuserid = Auth()->User()->id;
                $loginprofile = User::find($loginuserid)->Profile;
                if ($loginprofile == null) {
                    $noProfile = true;

                } else {
                    $loginprofileid = $loginprofile->id;
                    if ($loginprofileid == $id) {
                        $isSelf = true;
                    } else {
                        
                        $requestsents = Profile::find($loginprofileid)->Request_sent;
                        
                        foreach($requestsents as $requestsent) {
                            $profileidreceived = $requestsent->Request_received->profile_id;
                            if ($profileidreceived == $id) {
                                $isSent = true;
                                break;
                            }
                        }

                        $requestreceiveds = Profile::find($loginprofileid)->Request_received;
                        
                        foreach($requestreceiveds as $requestreceived) {
                            $profileidsent = $requestreceived->Request_sent->profile_id;
                            if ($profileidsent == $id) {
                                $isReceived = true;
                                $this->storeRecentlyViewedProfiles($profile, $loginprofile, $isSelf);
                                return view('view_profile', compact('profile','isSent','isGuest','isSelf','noProfile','isReceived'));
                            }
                        }
                        
                    }
                }
                
            }
            $this->storeRecentlyViewedProfiles($profile, $loginprofile, $isSelf);
            return view('view_profile', compact('profile','isSent','isGuest','isSelf','noProfile','isReceived'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::find($id);
        return view('edit_profile',compact('profile','id'));
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
        $profile = Profile::find($id);

        $profile_pic_path = $profile->profile_pic_path;

        if ($request->hasFile('profile_pic_path')) {
            $this->removeOldProfilePics($profile_pic_path);
            $profile_pic_path = $this->storeAndGetProfilePicPath($request);
        }

        $this->saveProfileData($profile, $request, $profile->status, $profile->user_id, $profile_pic_path);

        $homeController = new HomeController();
        $featuredProfiles = $homeController->getFeaturedProfiles();
        $allStates = $homeController->getAllStates();
        $allHobbies = $homeController->getAllHobbies();

        return view('index',compact('featuredProfiles','allStates','allHobbies'));
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

    public function saveProfileData(Profile $profile, Request $request, String $status, String $userid, $profile_pic_path) {
        
        $profile->profile_pic_path     =     $profile_pic_path;
        $profile->user_id              =     $userid;
        $profile->gender               =     $request->input('gender');
        $profile->physical_status      =     $request->input('physical_status');
        $height = $request->input('heightfeet');
        if ($height != null AND $request->input('heightinches') != null) {
            $height = $height . "." . $request->input('heightinches');
        }
        $profile->height               =     $height;
        $profile->weight               =     $request->input('weight');
        $profile->hobby                =     $request->input('hobby');
        $profile->complexion           =     $request->input('complexion');
        $profile->specs                =     $request->input('specs');
        $profile->vegetarian           =     $request->input('vegetarian');
        $profile->non_vegetarian       =     $request->input('non_vegetarian');
        $profile->eggetarian           =     $request->input('eggetarian');
        $profile->drink                =     $request->input('drink');
        $profile->smoke                =     $request->input('smoke');
        $profile->self_description     =     $request->input('self_description');
        $profile->profile_created_by   =     ($request->input('profile_created_by') == "Others") ? $request->input('profile_created_by_others') : $request->input('profile_created_by');
        $profile->subcast              =     $request->input('subcast');
        $profile->birth_date           =     $request->input('birth_date');

        $hour = $request->input('hour');
        $minute = $request->input('minute');
        $second = $request->input('second');
        $format = $request->input('format');
        if($format == "PM" && $hour!= 12)
        {
            $hour = $hour+12;
        }
        else if($format == "AM" && $hour == 12)
        {
            $hour = $hour-12;
        }
        $profile->birth_time           =     "$hour:$minute:$second";

        $profile->birth_place          =     $request->input('birth_place');
        $profile->native               =     $request->input('native');
        $profile->marital_status       =     $request->input('marital_status');
        $profile->rashi                =     $request->input('rashi');
        $profile->mangal               =     $request->input('mangal');
        $profile->shani                =     $request->input('shani');
        $profile->education            =     ($request->input('education') == "Others") ? $request->input('education_others') : $request->input('education');
        $profile->occupation           =     $request->input('occupation');
        $profile->area_of_business     =     $request->input('area_of_business');
        $profile->designation          =     $request->input('designation');
        $profile->company_name         =     $request->input('company_name');
        $profile->annual_income        =     $request->input('annual_income');
        $profile->contact_no           =     $request->input('contact_no');
        $profile->present_address      =     $request->input('present_address');
        $profile->present_city         =     $request->input('present_city');
        $profile->present_taluka       =     $request->input('present_taluka');
        $profile->present_district     =     $request->input('present_district');
        $profile->present_state        =     $request->input('present_state');
        $profile->present_country      =     $request->input('present_country');
        $profile->present_pincode      =     $request->input('present_pincode');
        $profile->permanent_address    =     $request->input('permanent_address');
        $profile->permanent_city       =     $request->input('permanent_city');
        $profile->permanent_taluka     =     $request->input('permanent_taluka');
        $profile->permanent_district   =     $request->input('permanent_district');
        $profile->permanent_state      =     $request->input('permanent_state');
        $profile->permanent_country    =     $request->input('permanent_country');
        $profile->permanent_pincode    =     $request->input('permanent_pincode');
        $profile->father_name          =     $request->input('father_name');
        $profile->father_occupation    =     $request->input('father_occupation');
        $profile->father_annual_income =     $request->input('father_annual_income');
        $profile->father_contact_no    =     $request->input('father_contact_no');
        $profile->mother_name          =     $request->input('mother_name');
        $profile->mother_occupation    =     $request->input('mother_occupation');
        $profile->mother_annual_income =     $request->input('mother_annual_income');
        $profile->mother_contact_no    =     $request->input('mother_contact_no');
        $profile->no_of_brothers       =     $request->input('no_of_brothers');
        $profile->no_of_sisters        =     $request->input('no_of_sisters');
        $profile->status               =     $status;
       
        $profile->save();
    }

    public function storeRecentlyViewedProfiles($viewdProfile, $viewerProfile, $isSelf) {
        if ($isSelf || $viewdProfile == null || $viewerProfile == null) {
            return;
        }

        $pastViewedProfiles = $viewerProfile->recently_viewed_profiles;     //This would be comma separated list of profile ID;

        if ($pastViewedProfiles == null) {
            // if this is the first profile viewed
            $pastViewedProfiles = $viewdProfile->id;
        } else {
            
            // If profiles viewed in the past
            $profileIdList = explode(",",$pastViewedProfiles);

            //checking if viewed profile exist in the list of past viewed profiles
            if (in_array($viewdProfile->id,$profileIdList)) {
                return;
            }

            if (sizeof($profileIdList) >= 5) {
                //removing the last profile id
                $pastViewedProfiles = substr($pastViewedProfiles,0,strripos($pastViewedProfiles,","));
            } 

            // prepending the recently viewed profile id
            $pastViewedProfiles = $viewdProfile->id . "," . $pastViewedProfiles;
           
        }

        $viewerProfile->recently_viewed_profiles = $pastViewedProfiles;
        $viewerProfile->save();
    }

    public function storeAndGetProfilePicPath($request) {

        $profile_pic_path = null;

        if ($request->hasFile('profile_pic_path') == false) {
            return $profile_pic_path;
        }

        $index = 0;
        foreach($request->file('profile_pic_path') as $file){
 
            //get filename with extension
            $filenamewithextension = $file->getClientOriginalName();
 
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
 
            //get file extension
            $extension = $file->getClientOriginalExtension();
 
            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
 
            Storage::put('public/profile_images/'. $filenametostore, fopen($file, 'r+'));
            Storage::put('public/profile_images/thumbnail/'. $filenametostore, fopen($file, 'r+'));
 
            //Resize image here
            $thumbnailpath = public_path('storage/profile_images/thumbnail/'.$filenametostore);
            $img = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            if ($index == 0) {
                $profile_pic_path = $filenametostore;
            } else {
                $profile_pic_path = $profile_pic_path . "," . $filenametostore;
            }
            $index = $index + 1;
        }
        return $profile_pic_path;
    }

    public function removeOldProfilePics($profile_pic_path) {
        $files = explode(",",$profile_pic_path);
        foreach($files as $file) {
            Storage::delete('public/profile_images/'. $file);
            Storage::delete('public/profile_images/thumbnail/'. $file);
        }
    }
}
