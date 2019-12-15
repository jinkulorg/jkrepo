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

Route::get('/', function () {
    return view('index');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/advanced_search',function(){
    return view('advanced_search');
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/profile','ProfilesController');
Route::resource('/requestsent','RequestSentController');
Route::resource('/requestreceived','RequestReceivedController');
Route::get('/id/{id}/profileid/{profileid}','RequestReceivedController@insertRequestReceived');
Route::get('/requestreceivedstore/{requestsentid}','RequestReceivedController@store');
Route::get('/requestreceiveddestroy/{requestreceivedid}','RequestReceivedController@destroy');
Route::resource('/reference','ReferenceController');
Route::post('/sendemail', 'HomeController@mail');


/**
 * Routes for Admin access
 */

Route::get('/admin', 'AdminController@admin')    
->middleware('is_admin')    
->name('admin');

Route::get('/manageuser','AdminController@manageUser')
->middleware('is_admin')
->name('manageuser');

Route::get('/manageprofile','AdminController@manageProfile')
->middleware('is_admin')
->name('manageprofile');

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