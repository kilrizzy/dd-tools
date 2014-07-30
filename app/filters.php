<?php
include('helpers/menuHelper.php');
include('helpers/alertHelper.php');
include('helpers/dataHelper.php');
//Pass $user to all views
global $sentry_user, $user, $isAdmin;
$user = false;
$isAdmin = false;
if (Sentry::check()){
    $sentry_user = Sentry::getUser();
    $user = User::find($sentry_user->id);
    //check admin
    $adminGroup = Sentry::findGroupByName('admin');
    if($sentry_user->inGroup($adminGroup)){
    	$isAdmin = true;
    }
}
View::share('sentry_user', $sentry_user);
View::share('user', $user);
View::share('isAdmin', $isAdmin);
View::share('data_list', $data_list);
/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/
Route::filter('auth.sentry', function()
{
	if ( ! Sentry::check()){
		alert('Please login to continue','danger');
		return Redirect::to('login');
	}
});
Route::filter('admin.sentry', function()
{
	if ( ! Sentry::check()){
		alert('Please login to continue','danger');
		return Redirect::to('login');
	}else{
		//check if admin
		$sentry_user = Sentry::getUser();
		$admin = Sentry::findGroupByName('Admin');
		if (!$sentry_user->inGroup($admin)){
			alert('Invalid Access','danger');
	        return Redirect::to('/');
	    }
	}
});
Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});
Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/
Route::filter('guest.sentry', function()
{
	if ( Sentry::check()){
		return Redirect::to('/');
	}
});
Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});


/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
