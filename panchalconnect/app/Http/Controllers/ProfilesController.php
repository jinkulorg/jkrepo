<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use Exception;
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
        if (Auth()->user() != null && strtoupper(Auth()->user()->lastname) != "PANCHAL" && strtoupper(Auth()->user()->lastname) != "LUHAR" && strtoupper(Auth()->user()->lastname) != "SUTHAR" && strtoupper(Auth()->user()->lastname) != "MISTRY" && strtoupper(Auth()->user()->lastname) != "GAJJAR") {
            return view('restrict_create_profile');
        } else {
            $homeController = new HomeController();
            $allHobbies = $homeController->getAllHobbies();
            return view('create_profile', compact('allHobbies'));
        }
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

         $returnMap = $this->storeAndGetProfilePicPath($request,"");

         $profile_pic_path = $returnMap["successpics"];
         $imageStoreResultMessage = "";
         if (sizeof($returnMap["failedpics"]) != 0) {
             $imageStoreResultMessage = " But Images: " . implode(',', $returnMap["failedpics"]) . " are not stored successfully. Please modify them and try again or use different image.";
         }
        $this->saveProfileData($profile, $request, "INACTIVE", Auth()->user()->id, $profile_pic_path);
        
        $homeController = new HomeController();
        $featuredProfiles = $homeController->getFeaturedProfiles();
        $allStates = $homeController->getAllStates();
        $allHobbies = $homeController->getAllHobbies();

        $successmsg = "Profile created successfully." . $imageStoreResultMessage;
        $isReceived = false;
        $isSent = false;
        $isGuest = false;
        $isSelf = true;
        $noProfile = false;
        $loginprofile = null;
        $failuremsg = "";

        // return view('index',compact('featuredProfiles','allStates','allHobbies'));
        return view('view_profile', compact('profile','isSent','isGuest','isSelf','noProfile','isReceived','allHobbies','successmsg','failuremsg'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $isReceived = false;
        $isSent = false;
        $isGuest = false;
        $isSelf = false;
        $noProfile = false;
        $loginprofile = null;
        $successmsg = "";
        $failuremsg = "";

        $homeController = new HomeController();
        $allHobbies = $homeController->getAllHobbies();

        $profile = Profile::find($id);
        if ($profile == false) {
            $failuremsg = "Profile not found for id: " . $id;
            return view('view_profile', compact('profile','isSent','isGuest','isSelf','noProfile','isReceived','allHobbies','successmsg', 'failuremsg'));

        } else {
           

            if ((Auth()->User()) == null) {
                $isGuest = true;

                if (Profile::find($id)->status != "ACTIVE" && Profile::find($id)->status != "MARRIED") {
                    $failuremsg = "Profile found for id: " . $id . " But it is not active. Please try again later.";
                    return view('view_profile', compact('profile','isSent','isGuest','isSelf','noProfile','isReceived','allHobbies','successmsg', 'failuremsg'));
                }

            } else {
                $loginuserid = Auth()->User()->id;
                $loginprofile = User::find($loginuserid)->Profile;
                if ($loginprofile == null) {
                    $noProfile = true;

                    if (Profile::find($id)->status != "ACTIVE" && Profile::find($id)->status != "MARRIED") {
                        $failuremsg = "Profile found for id: " . $id . " But it is not active. Please try again later.";
                        return view('view_profile', compact('profile','isSent','isGuest','isSelf','noProfile','isReceived','allHobbies','successmsg', 'failuremsg'));
                    }

                } else {
                    $loginprofileid = $loginprofile->id;
                    if ($loginprofileid == $id) {
                        $isSelf = true;
                    } else {
                        
                        if (Profile::find($id)->status != "ACTIVE" && Profile::find($id)->status != "MARRIED") {
                            $failuremsg = "Profile found for id: " . $id . " But it is not active. Please try again later.";
                            return view('view_profile', compact('profile','isSent','isGuest','isSelf','noProfile','isReceived','allHobbies','successmsg', 'failuremsg'));
                        }

                        $requestsents = Profile::find($loginprofileid)->Request_sent;
                        
                        foreach($requestsents as $requestsent) {
                            $profileidreceived = $requestsent->Request_received->profile_id;
                            if ($profileidreceived == $id && ($requestsent->Request_received->status == "NEW" || $requestsent->Request_received->status == "PENDING" || $requestsent->Request_received->status == "INTERESTED")) {
                                $isSent = true;
                            }
                        }

                        $requestreceiveds = Profile::find($loginprofileid)->Request_received;
                        
                        foreach($requestreceiveds as $requestreceived) {
                            $profileidsent = $requestreceived->Request_sent->profile_id;
                            if ($profileidsent == $id && ($requestreceived->status == "NEW" || $requestreceived->status == "PENDING" || $requestreceived->status == "INTERESTED")) {
                                $isReceived = true;
                            }
                        }
                        
                        if ($isReceived) {
                            $this->storeRecentlyViewedProfiles($profile, $loginprofile, $isSelf);
                            return view('view_profile', compact('profile','isSent','isGuest','isSelf','noProfile','isReceived','allHobbies','successmsg','failuremsg'));
                        }
                    }
                }
                
            }
            $this->storeRecentlyViewedProfiles($profile, $loginprofile, $isSelf);

            return view('view_profile', compact('profile','isSent','isGuest','isSelf','noProfile','isReceived','allHobbies','successmsg','failuremsg'));
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
        
        $homeController = new HomeController();
        $allHobbies = $homeController->getAllHobbies();

        return view('edit_profile',compact('profile','id','allHobbies'));
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

        $returnMap = $this->storeAndGetProfilePicPath($request, $profile_pic_path);
        $profile_pic_path = $returnMap["successpics"];
        $imageStoreResultMessage = "";
        if (sizeof($returnMap["failedpics"]) != 0) {
            $imageStoreResultMessage = " But Images: " . implode(',', $returnMap["failedpics"]) . " are not stored successfully. Please modify them and try again or use different image.";
        }
        $this->saveProfileData($profile, $request, $profile->status, $profile->user_id, $profile_pic_path);

        $homeController = new HomeController();
        $featuredProfiles = $homeController->getFeaturedProfiles();
        $allStates = $homeController->getAllStates();
        $allHobbies = $homeController->getAllHobbies();

        $successmsg = "Profile updated successfully." . $imageStoreResultMessage;
        $isReceived = false;
        $isSent = false;
        $isGuest = false;
        $isSelf = true;
        $noProfile = false;
        $loginprofile = null;
        $failuremsg = "";
        
        // return view('index',compact('featuredProfiles','allStates','allHobbies'));
        return view('view_profile', compact('profile','isSent','isGuest','isSelf','noProfile','isReceived','allHobbies','successmsg','failuremsg'));
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
        $profile->hobby                =     ($request->input('hobby') == "Others") ? $request->input('hobby_others') : $request->input('hobby');
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
        if ($hour != "" && $minute != "" && $format != "") {
            if($format == "PM" && $hour!= 12)
            {
                $hour = $hour+12;
            }
            else if($format == "AM" && $hour == 12)
            {
                $hour = $hour-12;
            }
            $profile->birth_time           =     "$hour:$minute:$second";
        }

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

    public function storeAndGetProfilePicPath($request, $oldProfilePicPath) {

        $oldPics = [];
        $removePics = [];
        $newPics = [];
        $failedImages = [];
        $returnMap = [];

        $removeFilesList = $request->input('removeFilesList');
        $removeFiles = explode(",",$removeFilesList);
        $oldProfilePicPaths = explode(",",$oldProfilePicPath);
        $i = 1;

        foreach ($oldProfilePicPaths as $oldProfilePic) {
            $oldPics["image".$i] = $oldProfilePic;
            if (in_array($oldProfilePic, $removeFiles)) {
                $removePics["image".$i] = $oldProfilePic;
            } else {
                $newPics["image".$i] = $oldProfilePic;
            }
            $i++;
        }

        if ($removeFilesList != "") {
            $this->removeOldProfilePics($removeFilesList);
            
        }

        for($fileIndex = 1 ; $fileIndex <= 4 ; $fileIndex++) {

            $inputFileName = "profile_pic_path" . $fileIndex;

            if ($request->hasFile($inputFileName) == false) {
                continue;
            }
            
            $file = $request->file($inputFileName);

            //get filename with extension
            $filenamewithextension = $file->getClientOriginalName();
 
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $file->getClientOriginalExtension();
 
            //filename to store
            $filenametostore = 'USER_' . Auth()->user()->id . '_'.uniqid() . '.' . $extension;
 
            try {
            Storage::put('public/profile_images/'. $filenametostore, fopen($file, 'r+'));
            Storage::put('public/profile_images/thumbnail/'. $filenametostore, fopen($file, 'r+'));
            Storage::put('public/profile_images/mainimage/'. $filenametostore, fopen($file, 'r+'));
 
            $imagepath = public_path('storage/profile_images/'.$filenametostore);
            $img = Image::make($imagepath);
            $img->save($imagepath);
            
            //Resize image here
            $imagepath = public_path('storage/profile_images/mainimage/'.$filenametostore);
            $img = Image::make($imagepath)->resize(400, 400, function($constraint) {
                // $constraint->aspectRatio();
            });
            $img->save($imagepath);

            $thumbnailpath = public_path('storage/profile_images/thumbnail/'.$filenametostore);
            $img = Image::make($thumbnailpath)->resize(100, 100, function($constraint) {
                // $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            $newPics["image".$fileIndex] = $filenametostore;
            } catch (Exception $e) {
                array_push($failedImages,$filename);
            } catch (Error $e2) {
                array_push($failedImages,$filename);
            }
        }
        
        ksort($newPics);
        $returnMap["successpics"] = implode(',', array_values($newPics));
        $returnMap["failedpics"] =  $failedImages;
        return $returnMap;
    }

    public function removeOldProfilePics($profile_pic_path) {
        $files = explode(",",$profile_pic_path);
        foreach($files as $file) {
            Storage::delete('public/profile_images/'. $file);
            Storage::delete('public/profile_images/thumbnail/'. $file);
            Storage::delete('public/profile_images/mainimage/'. $file);
        }
    }
    public function gotPaymentAndActivateProfile($id) {
        $profile = Profile::find($id);
        if ($profile == null) {
            return false;
        }
        
        $paymentController = new PaymentController();

        if($paymentController->isPaymentReceived($id)) {
            $profile->status = 'ACTIVE';
            $profile->save();
            return true;
        } else {
            return false;
        }
    }

    public function activateProfileForFree($id) {
        $profile = Profile::find($id);
        if ($profile == null) {
            return view('/activate');
        }

        $profile->status = 'ACTIVE';
        $profile->save();

        $paymentController = new PaymentController();

        $params['PROFILE_ID'] = $id;
        $params['ORDERID'] = "Not Available";
        $params['MID'] = "Not Available";
        $params['TXNID'] = "Not Available";
        $params['TXNAMOUNT'] = 0;
        $params['PAYMENTMODE'] = "Not Available";
        $params['CURRENCY'] = "Not Available";
        $params['TXNDATE'] = date("Y-m-d");
        $params['STATUS'] = "TXN_SUCCESS";
        $params['RESPCODE'] = "Not Available";
        $params['RESPMSG'] = "Not Available";
        $params['GATEWAYNAME'] = "Not Available";
        $params['BANKTXNID'] = "Not Available";
        $params['BANKNAME'] = "Not Available";
        $params['CHECKSUMHASH'] = "Not Available";
        $params['SOURCE'] = "P";

        $paymentController->storePaymentDetails($params);
        return view('payment.activate');
    }
}
