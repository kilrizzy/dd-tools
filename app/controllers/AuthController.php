<?php

class AuthController extends BaseController {

	//LOGIN DISPLAY
	public function loginDisplay()
	{
		return View::make('auth/login');
	}
	//LOGIN PROCESS
	public function loginProcess(){
		$credentials = array(
	        'email'    => Input::get('email'),
	        'password' => Input::get('password'),
	    );
	    try{
		    // Try to authenticate the user
		    $user = Sentry::authenticate($credentials, false);
		    //print_r($user);
			return Redirect::to('dashboard');
		}catch (Cartalyst\Sentry\Users\LoginRequiredException $e){
		    alert('Login Field Required','danger');
			return Redirect::to('login');
		}catch (Cartalyst\Sentry\Users\PasswordRequiredException $e){
		    alert('Password Required','danger');
			return Redirect::to('login')->withInput();
		}catch (Cartalyst\Sentry\Users\WrongPasswordException $e){
		    alert('Invalid Password','danger');
			return Redirect::to('login')->withInput();
		}catch (Cartalyst\Sentry\Users\UserNotFoundException $e){
		    alert('User not found','danger');
			return Redirect::to('login');
		}catch (Cartalyst\Sentry\Users\UserNotActivatedException $e){
		    alert('User not activated','danger');
			return Redirect::to('login')->withInput();
		}
	}
	//RESET DISPLAY
	public function resetDisplay()
	{
		return View::make('auth/reset');
	}
	//RESET PROCESS
	public function resetProcess(){
    	$user = Sentry::findUserByLogin(Input::get('email'));
    	if($user){
	    	$resetCode = $user->getResetPasswordCode();
	    	$data = array(
			   	'resetCode' => $resetCode
			);
			try {
				Mail::send('emails.reset', $data, function($message){
				    $message->to(Input::get('email'))->subject('Reset your BizLenders Password');
				});
				alert('Please check your email, you will recieve an activation link to reset your password','success');
				return Redirect::to('reset');
			}catch(Exception $e){
				//error
				echo 'Error sending email';
			}
		}else{
			alert('We do not appear to have your email address in our system','warning');
			return Redirect::to('reset');
		}
	}
	//RESET ACTION
	public function resetAction($rid){
		try{
			$user = Sentry::findUserByResetPasswordCode($rid);
			$password = str_random(12);
			// Attempt to reset the user password
	        if ($user->attemptResetPassword($rid, $password)){
	        	//Activate if they have not
	        	$user->activated = 1;
	        	$user->save();
	        	//Login user
	        	Sentry::login($user, false);
	        	//Send to profile to edit their pw
	        	alert('Please choose a new password below','success');
	        	return Redirect::to('profile');
	        }else{
	            echo 'error';
	        }
		}catch (Cartalyst\Sentry\Users\UserNotFoundException $e){
			echo 'User error';
		}
	}
	//USER LOGOUT
	public function logoutProcess(){
		global $user;
		//Sign out of faux user
		if(isset($user->id)){
			$user->faux_user_id = 0;
			$user->save();
		}
		//
		Sentry::logout();
		alert('You are successfully logged out');
		return Redirect::to('login');
	}
	//PROFILE DISPLAY
	public function profileDisplay()
	{
		return View::make('auth/profile');
	}
	/* USER UPDATE PROFILE*/
	public function profileProcess()
	{
		try{
			$user = Sentry::getUser();
			//make sure email is not taken by another account!
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->email = Input::get('email');
			$password = trim(Input::get('password'));
			if(!empty($password)){
				$user->password = $password;
			}
			if ($user->save()){
		        alert('Profile saved successfully');
				return Redirect::to('dashboard');
		    }else{
		        alert('Error, profile not saved','danger');
				return Redirect::to('profile');
		    }
		}catch (Cartalyst\Sentry\Users\UserExistsException $e){
			alert('Error, user exists','danger');
			return Redirect::to('profile');
		}catch (Cartalyst\Sentry\Users\UserNotFoundException $e){
			alert('Error, user not found','danger');
			return Redirect::to('profile');
		}
	}
	/*ACTIVATE USER BY AID*/
	public function activateDisplay($aid){
		//get user by aid, 
		try{
		    $user = Sentry::findUserByActivationCode($aid);
		}catch (Cartalyst\Sentry\Users\UserNotFoundException $e){
		    alert('User not found');
			return Redirect::to('login');
		}
		if($user){
			//Activate
			if ($user->attemptActivation($aid)){
		        // User activation passed / Success + Login
		        Sentry::login($user, false);
		        alert('Login Successful');
				return Redirect::to('dashboard');
		    }else{
		        // User activation failed / Error + Login
		        alert('Error, please login','danger');
				return Redirect::to('login');
		    }
		}
	}
}