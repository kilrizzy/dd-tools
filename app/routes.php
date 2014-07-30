<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('pages/home');
});
//AUTH
Route::get('login', 'AuthController@loginDisplay')->before('guest.sentry');
Route::post('login', 'AuthController@loginProcess')->before('guest.sentry');
Route::get('reset', 'AuthController@resetDisplay')->before('guest.sentry');
Route::post('reset', 'AuthController@resetProcess')->before('guest.sentry');
Route::get('reset/{rid?}', 'AuthController@resetAction')->before('guest.sentry');
Route::get('profile', 'AuthController@profileDisplay')->before('auth.sentry');
Route::post('profile', 'AuthController@profileProcess')->before('auth.sentry');
Route::get('activate/{aid?}', 'AuthController@activateDisplay');
//LOGOUT
Route::get('logout', 'AuthController@logoutProcess')->before('auth.sentry');
//DASHBOARD
Route::get('dashboard', 'DashboardController@dashboardDisplay')->before('auth.sentry');
//ADMIN USERS
Route::get('admin/users', 'UserController@usersDisplay')->before('admin.sentry');
Route::get('admin/user/{id?}', 'UserController@userDisplay')->before('admin.sentry')->where('id','\d+');
Route::post('admin/user/{id?}', 'UserController@userProcess')->before('admin.sentry')->where('id','\d+');
Route::delete('admin/user', 'UserController@userDelete')->before('admin.sentry');
//ADMIN CAMPAIGNS
//ADMIN CHARACTERS
Route::get('admin/characters', 'CharacterController@charactersDisplay')->before('admin.sentry');
Route::get('admin/character/{id?}', 'CharacterController@characterDisplay')->before('admin.sentry')->where('id','\d+');
Route::post('admin/character/{id?}', 'CharacterController@characterProcess')->before('admin.sentry')->where('id','\d+');
Route::delete('admin/character', 'CharacterController@characterDelete')->before('admin.sentry');