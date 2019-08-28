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

Route::get('/messages',function(){
    return view('messages');
});
Route::get('/contact',function(){
    return view('contact');
});
Route::get('/create_profile',function(){
    return view('create_profile');
});
Route::get('/view_profile',function(){
    return view('view_profile');
});
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
Route::resource('/profile','CreateProfilesController');