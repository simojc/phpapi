<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Register route
Route::post('signup', 'AuthController@register');

// Login route
Route::post('login', 'AuthController@login');

//User route to access current user information
Route::group(['middleware' => 'jwt.auth'], function(){
  Route::get('auth/user', 'AuthController@user');
});

//User route to access current user information
//Route::group(['middleware' => 'jwt.auth'], function(){
  Route::get('users', 'AuthController@index');
//});

// route to logout
Route::group(['middleware' => 'jwt.auth'], function(){
   Route::post('auth/logout', 'AuthController@logout');
});

//route to check the current token is valid or not and refresh the token if it is not invalidated.
Route::middleware('jwt.refresh')->get('/token/refresh', 'AuthController@refreshToken');


 Route::group(['middleware' => 'jwt.auth'], function(){
   Route::resource('products', 'ProductController');
 });


 Route::group(['middleware' => 'jwt.auth'], function(){
   Route::resource('engmts', 'EngmtController');
 });

 Route::group(['middleware' => 'jwt.auth'], function(){
   Route::resource('engmtpers', 'EngmtpersController');
 });

 // Route::group(['middleware' => 'jwt.auth'], function(){
 //   Route::resource('events', 'EventController');
 // });

 Route::resource('events', 'EventController');

 //Route::group(['middleware' => 'jwt.auth'], function(){
   Route::resource('evnmts', 'EvnmtController');
 //});

 //Route::group(['middleware' => 'jwt.auth'], function(){
    Route::resource('groupes', 'GroupeController');
// });

 //Route::group(['middleware' => 'jwt.auth'], function(){
   Route::resource('locations', 'LocationController');
 //});

 //Route::group(['middleware' => 'jwt.auth'], function(){
   Route::resource('pers', 'PersController');
 //});

 Route::group(['middleware' => 'jwt.auth'], function(){
   Route::resource('products', 'ProductController');
 });

 //Route::group(['middleware' => 'jwt.auth'], function(){
   Route::resource('rpnpers', 'RpnpersController');
 //});

 Route::group(['middleware' => 'jwt.auth'], function(){
   Route::resource('sessions', 'SessionController');
 });

 Route::group(['middleware' => 'jwt.auth'], function(){
   Route::resource('tonts', 'TontController');
 });

 Route::group(['middleware' => 'jwt.auth'], function(){
   Route::resource('tontpers', 'TontpersController');
 });
