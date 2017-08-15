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

use App\Http\Controllers;

#Route::get('/', function () {
#	$var = 'test variable';
#	return view('index', ['var' => $var]);
#});

Route::get('/', function () {
    return view('index');
});


Route::get('/about', function () {
	return view('about');
});

Route::get('/events', function () {
	return view('events');
});

Route::get('/profile', function () {
	$val = Session::get('user_agent');
	return view('profile', ['val' => $val]);
});



Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/service_post', function () {
    return view('service_post');
});

Route::get('/report_to_us', function () {
    return view('report_to_us');
});

//Route::get('/edit_profile', function () {
//    return view('edit_profile');
//});

//Route::get('/services', function () {
//    return view('services');
//});

Route::get('/browse', 'ServiceOperations@browse');
//Route::get('/service_post', 'ServiceOperations@post_comment');

//Route::get('list_service', function() {
//	return Redirect::action('ServiceOperations@list_service');
//});

Route::resource('service', 'UserSetup');

Route::post('/some/url', 'FunctionController@function');
Route::post('/registration',['uses'=>'UserSetup@getregistration','as'=>'registration']);


//Route::get('/profile', function () {
//	$val = Session::get('user_agent');
//	if ($val) {
//        return view('profile');
//    } else {
//    	return view('login');
//    }
//});

Route::post('login', array('uses' => 'UserSetup@login_ctrl'));
Route::get('/profile', 'UserProfile@view_profile');
Route::post('profile', array('uses' => 'UserProfile@edit_profile'));

Route::post('register', array('uses' => 'UserSetup@register_ctrl'));

Route::post('service_post', array('uses' => 'ServiceOperations@post_comment'));

Route::get('rate_user', array('uses' => 'UserProfile@rate_user'));

Route::get('service_post', array('uses' => 'ServiceOperations@service_post'));

Route::get('delete_post', array('uses' => 'ServiceOperations@delete_post'));

Route::post('add_service', array('uses' => 'ServiceOperations@add_service_ctrl'));
Route::post('search_service_ctrl', array('uses' => 'ServiceOperations@search_service_ctrl'));
//Route::post('logaout', array('uses' => 'ServiceController@logaout'));

 Route::get('/logout', function() {
 Cache::flush();
 Session::flush();
 Session::save();
 return Redirect::to('/')->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
 });


