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
        if (Auth()->user() != null && strtoupper(Auth()->user()->lastname) != "PANCHAL" && strtoupper(Auth()->user()->lastname) != "LUHAR" && strtoupper(Auth()->user()->lastname) != "SUTHAR" && strtoupper(Auth()->user()->lastname) != "MISTRY" && strtoupper(Auth()->user()->lastname) != "GAJJAR" && strtoupper(Auth()->user()->lastname) != "VISHWAKARMA") {
            return view('restrict_create_profile');
        } else if(Auth()->user() != null && Auth()->user()->email_verified_at == null) {
            return view('verify_email_warning');
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
        //  $returnMap = $this->storeAndGetProfilePicPath($request,"",Auth()->user()->id);

        //  $profile_pic_path = $returnMap["successpics"];
        //  $imageStoreResultMessage = "";
        //  if (sizeof($returnMap["failedpics"]) != 0) {
        //      $imageStoreResultMessage = " But Images: " . implode(',', $returnMap["failedpics"]) . " are not stored successfully. Please modify them and try again or use different image.";
        //  }
        $this->saveProfileData($profile, $request, "INACTIVE", Auth()->user()->id, null);
        
        $homeController = new HomeController();
        $featuredProfiles = $homeController->getFeaturedProfiles();
        $allStates = $homeController->getAllStates();
        $allHobbies = $homeController->getAllHobbies();

        $successmsg = "Profile created successfully.";
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

        // $profile_pic_path = $profile->profile_pic_path;

        // $returnMap = $this->storeAndGetProfilePicPath($request, $profile_pic_path, $profile->user_id);
        // $profile_pic_path = $returnMap["successpics"];
        // $imageStoreResultMessage = "";
        // if (sizeof($returnMap["failedpics"]) != 0) {
        //     $imageStoreResultMessage = " But Images: " . implode(',', $returnMap["failedpics"]) . " are not stored successfully. Please modify them and try again or use different image.";
        // }
        $this->saveProfileData($profile, $request, $profile->status, $profile->user_id, $profile->profile_pic_path);

        $homeController = new HomeController();
        $featuredProfiles = $homeController->getFeaturedProfiles();
        $allStates = $homeController->getAllStates();
        $allHobbies = $homeController->getAllHobbies();

        $successmsg = "Profile updated successfully.";
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
        $profile->gender               =     ($request->input('gender') != null) ? $request->input('gender') : $profile->gender;
        $profile->physical_status      =     ($request->input('physical_status') != null) ? $request->input('physical_status') : $profile->physical_status;
        $height = ($request->input('heightfeet') != null) ? $request->input('heightfeet') : $profile->height;
        if ($height != null AND $request->input('heightinches') != null) {
            $height = $height . "." . $request->input('heightinches');
        }
        $profile->height               =     $height;
        $profile->weight               =     ($request->input('weight') != null) ? $request->input('weight') : $profile->weight;
        $profile->hobby                =     ($request->input('hobby') == "Others") ? (($request->input('hobby_others') != null) ? $request->input('hobby_others') : $profile->hobby) : (($request->input('hobby') != null) ? $request->input('hobby') : $profile->hobby);
        $profile->complexion           =     ($request->input('complexion') != null) ? $request->input('complexion') : $profile->complexion;
        $profile->specs                =     ($request->input('specs') != null) ? $request->input('specs') : $profile->specs;
        $profile->vegetarian           =     ($request->input('vegetarian') != null) ? $request->input('vegetarian') : $profile->vegetarian;
        $profile->non_vegetarian       =     ($request->input('non_vegetarian') != null) ? $request->input('non_vegetarian') : $profile->non_vegetarian;
        $profile->eggetarian           =     ($request->input('eggetarian') != null) ? $request->input('eggetarian') : $profile->eggetarian;
        $profile->drink                =     ($request->input('drink') != null) ? $request->input('drink') : $profile->drink;
        $profile->smoke                =     ($request->input('smoke') != null) ? $request->input('smoke') : $profile->smoke;
        $profile->self_description     =     ($request->input('self_description') != null) ? $request->input('self_description') : $profile->self_description;
        $profile->profile_created_by   =     ($request->input('profile_created_by') == "Others") ? (($request->input('profile_created_by_others') != null) ? $request->input('profile_created_by_others') : $profile->profile_created_by) : (($request->input('profile_created_by') != null) ? $request->input('profile_created_by') : $profile->profile_created_by);
        $profile->subcast              =     ($request->input('subcast') != null) ? $request->input('subcast') : $profile->subcast;
        $profile->birth_date           =     ($request->input('birth_date') != null) ? $request->input('birth_date') : $profile->birth_date;

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

        $profile->birth_place          =     ($request->input('birth_place') != null) ? $request->input('birth_place') : $profile->birth_place;
        $profile->native               =     ($request->input('native') != null) ? $request->input('native') : $profile->native;
        $profile->marital_status       =     ($request->input('marital_status') != null) ? $request->input('marital_status') : $profile->marital_status;
        $profile->rashi                =     ($request->input('rashi') != null) ? $request->input('rashi') : $profile->rashi;
        $profile->mangal               =     ($request->input('mangal') != null) ? $request->input('mangal') : $profile->mangal;
        $profile->shani                =     ($request->input('shani') != null) ? $request->input('shani') : $profile->shani;
        $profile->education            =     ($request->input('education') == "Others") ? (($request->input('education_others') != null) ? $request->input('education_others') : $profile->education) : (($request->input('education') != null) ? $request->input('education') : $profile->education);
        $profile->occupation           =     ($request->input('occupation') != null) ? $request->input('occupation') : $profile->occupation;
        
        if ($request->input('occupation') != null && $request->input('occupation')  == 'Business') {
            $profile->area_of_business     =     ($request->input('area_of_business') != null) ? $request->input('area_of_business') : $profile->area_of_business;
        } else {
            $profile->area_of_business     =     $request->input('area_of_business');
        }
        
        if ($request->input('occupation') != null && $request->input('occupation')  == 'Job') {
            $profile->designation          =     ($request->input('designation') != null) ? $request->input('designation') : $profile->designation;
        } else {
            $profile->designation          =     $request->input('designation');
        }
        
        if ($request->input('occupation') != null && ($request->input('occupation')  == 'Job' || $request->input('occupation')  == 'Business')) {
            $profile->company_name         =     ($request->input('company_name') != null) ? $request->input('company_name') : $profile->company_name;
            $profile->annual_income        =     ($request->input('annual_income') != null) ? $request->input('annual_income') : $profile->annual_income;
        } else {
            $profile->company_name         =     $request->input('company_name');
            $profile->annual_income        =     $request->input('annual_income');
        }
        
        $profile->contact_no           =     ($request->input('contact_no') != null) ? $request->input('contact_no') : $profile->contact_no;
        $profile->present_address      =     ($request->input('present_address') != null) ? $request->input('present_address') : $profile->present_address;
        $profile->present_city         =     ($request->input('present_city') != null) ? $request->input('present_city') : $profile->present_city;
        $profile->present_taluka       =     ($request->input('present_taluka') != null) ? $request->input('present_taluka') : $profile->present_taluka;
        $profile->present_district     =     ($request->input('present_district') != null) ? $request->input('present_district') : $profile->present_district;
        $profile->present_state        =     ($request->input('present_state') != null) ? $request->input('present_state') : $profile->present_state;
        $profile->present_country      =     ($request->input('present_country') != null) ? $request->input('present_country') : $profile->present_country;
        $profile->present_pincode      =     ($request->input('present_pincode') != null) ? $request->input('present_pincode') : $profile->present_pincode;
        $profile->permanent_address    =     ($request->input('permanent_address') != null) ? $request->input('permanent_address') : $profile->permanent_address;
        $profile->permanent_city       =     ($request->input('permanent_city') != null) ? $request->input('permanent_city') : $profile->permanent_city;
        $profile->permanent_taluka     =     ($request->input('permanent_taluka') != null) ? $request->input('permanent_taluka') : $profile->permanent_taluka;
        $profile->permanent_district   =     ($request->input('permanent_district') != null) ? $request->input('permanent_district') : $profile->permanent_district;
        $profile->permanent_state      =     ($request->input('permanent_state') != null) ? $request->input('permanent_state') : $profile->permanent_state;
        $profile->permanent_country    =     ($request->input('permanent_country') != null) ? $request->input('permanent_country') : $profile->permanent_country;
        $profile->permanent_pincode    =     ($request->input('permanent_pincode') != null) ? $request->input('permanent_pincode') : $profile->permanent_pincode;
        $profile->father_name          =     ($request->input('father_name') != null) ? $request->input('father_name') : $profile->father_name;
        $profile->father_occupation    =     ($request->input('father_occupation') != null) ? $request->input('father_occupation') : $profile->father_occupation;
        $profile->father_annual_income =     ($request->input('father_annual_income') != null) ? $request->input('father_annual_income') : $profile->father_annual_income;
        $profile->father_contact_no    =     ($request->input('father_contact_no') != null) ? $request->input('father_contact_no') : $profile->father_contact_no;
        $profile->mother_name          =     ($request->input('mother_name') != null) ? $request->input('mother_name') : $profile->mother_name;
        $profile->mother_occupation    =     ($request->input('mother_occupation') != null) ? $request->input('mother_occupation') : $profile->mother_occupation;
        $profile->mother_annual_income =     ($request->input('mother_annual_income') != null) ? $request->input('mother_annual_income') : $profile->mother_annual_income;
        $profile->mother_contact_no    =     ($request->input('mother_contact_no') != null) ? $request->input('mother_contact_no') : $profile->mother_contact_no;
        $profile->no_of_brothers       =     ($request->input('no_of_brothers') != null) ? $request->input('no_of_brothers') : $profile->no_of_brothers;
        $profile->no_of_sisters        =     ($request->input('no_of_sisters') != null) ? $request->input('no_of_sisters') : $profile->no_of_sisters;
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

            if (sizeof($profileIdList) >= 10) {
                //removing the last profile id
                $pastViewedProfiles = substr($pastViewedProfiles,0,strripos($pastViewedProfiles,","));
            } 

            // prepending the recently viewed profile id
            $pastViewedProfiles = $viewdProfile->id . "," . $pastViewedProfiles;
           
        }

        $viewerProfile->recently_viewed_profiles = $pastViewedProfiles;
        $viewerProfile->save();
    }

    public function storeAndGetProfilePicPath($request, $oldProfilePicPath, $profileid) {

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

            $size = $request->file($inputFileName)->getSize();

            if ($size > 2000000) {
                array_push($failedImages,$filename);
                continue;
            }

            //get file extension
            $extension = $file->getClientOriginalExtension();
 
            //filename to store
            $filenametostore = 'PROFILE_' . $profileid . '_'.uniqid() . '.' . $extension;
 
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
            return back();
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

        $paymentController->storePaymentDetails($params, $id);

        // return view('payment.activate');
        $msg = 'Profile ' . $id . ' is acivated successfully';
        return back()->with('success', $msg);
    }

    public function promoteProfileForFree(Request $request, $id) {
        $profile = Profile::find($id);
        if ($profile == null) {
            return back();
        }

        if ($profile->status != 'ACTIVE') {
            return back()->with('failure','Profile is not active');
        }

        $plan = $request->get('plan');

        if ($plan == "") {
            return back()->with('failure','Please select plan');
        }

        $featuredProfileController = new FeaturedProfileController();
        $result = $featuredProfileController->storeFeaturedProfile($plan, $id);

        if ($result == false) {
            return back()->with('failure','Error in creating Featured Profile data');
        }

        $paymentController = new PaymentController();

        $params['PROFILE_ID'] = $id;
        $params['ORDERID'] = "Not Available";
        $params['MID'] = "Not Available";
        $params['TXNID'] = "Not Available";

        if ($plan == "plan1") {
            $params['TXNAMOUNT'] = PLAN1_AMOUNT;
        } else if ($plan == "plan2") {
            $params['TXNAMOUNT'] = PLAN2_AMOUNT;
        } else if ($plan == "plan3") {
            $params['TXNAMOUNT'] = PLAN3_AMOUNT;
        } else {
            $params['TXNAMOUNT'] = "0";
        }
        
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
        $params['SOURCE'] = "FP";

        $paymentController->storePaymentDetails($params, $id);
        $msg = 'Profile ' . $id . ' is promoted successfully with plan ' . $plan;
        return back()->with('success', $msg);
    }
    public function manageProfilePic($id) {
        $profile = Profile::find($id);
        return view('manage_profile_pic',compact('profile'));
    }

    public function updateProfilePic(Request $request, $id) {
        $profile = Profile::find($id);

        $profile_pic_path = $profile->profile_pic_path;

        $returnMap = $this->storeAndGetProfilePicPath($request, $profile_pic_path, $id);
        $profile_pic_path = $returnMap["successpics"];
        $imageStoreResultMessage = "";
        if (sizeof($returnMap["failedpics"]) != 0) {
            $imageStoreResultMessage = "Images: " . implode(',', $returnMap["failedpics"]) . " are not stored successfully. Please modify them and try again or use different image.";
        }
        
        if ($imageStoreResultMessage != "") {
            return back()->with('failure',$imageStoreResultMessage);    
        }

        $profile->profile_pic_path = $profile_pic_path;
        $profile->save();

        $homeController = new HomeController();
        $featuredProfiles = $homeController->getFeaturedProfiles();
        $allStates = $homeController->getAllStates();
        $allHobbies = $homeController->getAllHobbies();

        if ($imageStoreResultMessage == "") {
            $successmsg = "Your profile pics are added or updated successfully.";
            $failuremsg = "";
        } else {
            $successmsg = "";
            $failuremsg = $imageStoreResultMessage;
        }
        $isReceived = false;
        $isSent = false;
        $isGuest = false;
        $isSelf = true;
        $noProfile = false;
        $loginprofile = null;
        
        // return view('index',compact('featuredProfiles','allStates','allHobbies'));
        return view('view_profile', compact('profile','isSent','isGuest','isSelf','noProfile','isReceived','allHobbies','successmsg','failuremsg'));
    }
}
