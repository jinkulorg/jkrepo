<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Route::get('/about', function () {
    return view('about');
});

Route::get('/requests','RequestController@index')->name('requests.index');

Route::get('/contact',function(){
    return view('contact');
})->name('contact');
Route::get('/faq',function(){
    return view('faq');
});
Route::get('/privacy',function(){
    return view('privacy');
});
Route::get('/terms',function(){
    return view('terms');
});
Route::get('/feedback',function(){
    return view('feedback');
});
Route::get('/disclaimer',function(){
    return view('disclaimer');
});

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/profile','ProfilesController');
Route::resource('/requestsent','RequestSentController');
Route::resource('/requestreceived','RequestReceivedController');
Route::get('/id/{id}/profileid/{profileid}','RequestReceivedController@insertRequestReceived');
Route::get('/requestreceivedstore/{requestsentid}','RequestReceivedController@store');
Route::get('/requestreceiveddestroy/{requestreceivedid}','RequestReceivedController@destroy');
Route::resource('/reference','ReferenceController');
Route::post('/sendemail', 'HomeController@mail');
Route::resource('/married','MarriedController');
Route::resource('/featuredprofile','FeaturedProfileController');
Route::resource('/account','AccountController');

/**
 * Route for Profile pic
 */
Route::get('/profile/{profile}/manageProfilePic', 'ProfilesController@manageProfilePic')->name('profile.manageProfilePic');
Route::PATCH('profile/{profile}/updateProfilePic','ProfilesController@updateProfilePic')->name('profile.updateProfilePic');
 
/**
 * Routes for Admin access
 */

Route::get('/admin', 'AdminController@admin')    
->middleware('is_admin')    
->name('admin');

Route::get('/adminsearch', 'AdminController@adminsearch')    
->middleware('is_admin')    
->name('adminsearch');

Route::get('/manageuser','AdminController@manageUser')
->middleware('is_admin')
->name('manageuser');

Route::get('/manageprofile','AdminController@manageProfile')
->middleware('is_admin')
->name('manageprofile');

Route::get('/getAllNewRequestReceived','AdminController@getAllNewRequestReceived')
->middleware('is_admin')
->name('getAllNewRequestReceived');

Route::get('/managefeaturedprofile','AdminController@manageFeaturedProfile')
->middleware('is_admin')
->name('managefeaturedprofile');

Route::get('/admin/{id}/editUser','AdminController@editUser')
->middleware('is_admin')
->name('admin.editUser');

Route::Patch('/admin/user/{id}','AdminController@updateUser')
->middleware('is_admin')
->name('admin.user.updateUser');

Route::delete('/admin/user/{id}','AdminController@destroyUser')
->middleware('is_admin')
->name('admin.user.destroyUser');

Route::delete('/admin/profile/{id}','AdminController@destroyProfile')
->middleware('is_admin')
->name('admin.profile.destroyProfile');

Route::Patch('/admin/profileactive/{id}','AdminController@activate')
->middleware('is_admin')
->name('admin.profileactive.activate');

Route::Patch('/admin/profileinactive/{id}','AdminController@inactivate')
->middleware('is_admin')
->name('admin.profileinactive.inactivate');


Route::delete('/admin/featuredprofile/{id}','AdminController@destroyFeaturedProfile')
->middleware('is_admin')
->name('admin.profile.destroyFeaturedProfile');

// Route::Patch('/admin/featuredprofileapprove/{id}','AdminController@approveFeaturedProfile')
// ->middleware('is_admin')
// ->name('admin.profileapprove.approve');

// Route::Patch('/admin/featuredprofilereject/{id}','AdminController@rejectFeaturedProfile')
// ->middleware('is_admin')
// ->name('admin.profilereject.reject');

Route::get('/admin/getuser','AdminController@getUser')
->middleware('is_admin')
->name('admin.getuser');

Route::get('/admin/getuserFromEmail','AdminController@getuserFromEmail')
->middleware('is_admin')
->name('admin.getuserFromEmail');

Route::get('/admin/getuserFromName','AdminController@getuserFromName')
->middleware('is_admin')
->name('admin.getuserFromName');

Route::get('/admin/getprofile','AdminController@getProfile')
->middleware('is_admin')
->name('admin.getprofile');

Route::get('/admin/getTotalUsersWithProfile','AdminController@getTotalUsersWithProfile')
->middleware('is_admin')
->name('admin.getTotalUsersWithProfile');

Route::get('/admin/getTotalUsersWithNoProfile','AdminController@getTotalUsersWithNoProfile')
->middleware('is_admin')
->name('admin.getTotalUsersWithNoProfile');

Route::get('/admin/getActiveProfiles','AdminController@getActiveProfiles')
->middleware('is_admin')
->name('admin.getActiveProfiles');

Route::get('/admin/getInActiveProfiles','AdminController@getInActiveProfiles')
->middleware('is_admin')
->name('admin.getInActiveProfiles');

Route::get('/admin/getMarriedProfiles','AdminController@getMarriedProfiles')
->middleware('is_admin')
->name('admin.getMarriedProfiles');

Route::get('/admin/getMaleProfiles','AdminController@getMaleProfiles')
->middleware('is_admin')
->name('admin.getMaleProfiles');

Route::get('/admin/getFemaleProfiles','AdminController@getFemaleProfiles')
->middleware('is_admin')
->name('admin.getFemaleProfiles');

Route::get('/admin/getRenewProfiles','AdminController@getRenewProfiles')
->middleware('is_admin')
->name('admin.getRenewProfiles');

Route::get('/admin/getFeaturedProfile','AdminController@getFeaturedProfile')
->middleware('is_admin')
->name('admin.getFeaturedProfile');

/**
 * Routes for Search
 */
Route::get('/basicsearch','SearchController@basicSearch')->name('basicsearch');

Route::get('/advanced_search_open','SearchController@openAdvancedSearch');

Route::get('/advanced_search','SearchController@advancedSearch');

Route::get('/reference_search_open','SearchController@openReferenceSearch');

Route::get('/reference_search','SearchController@referenceSearch');

Route::get('/activate',function(){
    return view('payment.activate');
})->name('payment.activate');

Route::post('/pgRedirect',function(){
    return view('payment.pgRedirect');
});

Route::post('/paymentresponse',function(){
    return view('payment.pgResponse');
});

Route::resource('/payment','PaymentController');

Route::post('/FPpaymentresponse',function(){
    return view('payment.FPpgResponse');
});

Route::Patch('/profile/activateProfileForFree/{id}','ProfilesController@activateProfileForFree')
->name('profile.profileactive.activateForFree');

Route::Patch('/profile/promoteProfileForFree/{id}','ProfilesController@promoteProfileForFree')
->name('profile.profileactive.promoteForFree');

/**
 * Affiliate Program
 */
Route::get('/affiliate','AffiliateController@index');