<?php

class UserController extends BaseController {

	//USERS DISPLAY
	public function usersDisplay(){
		$users = Sentry::findAllUsers(); //NOT ADMIN
		return View::make('users/users',array('users'=>$users));
	}

	//USER DISPLAY
	public function userDisplay($id=false)
	{
		global $data_list;

		$edituser = new stdClass();
		$edituser->id = 0;
		$edituser->email = '';
		$edituser->first_name = '';
		$edituser->last_name = '';
		$edituser->group = '';
		if($id){
			$edituser = Sentry::findUserById($id);
			foreach ($edituser->groups()->get() as $group){
				$edituser->group = $group->name;
			}
		}
		return View::make('users/user',array('edituser'=>$edituser,'data_list'=>$data_list));
	}
	//USERS PROCESS
	public function userProcess($id=false){
		if($id){
			//Get user
			try{
			    $edituser = Sentry::findUserById($id);
			    $edituser->first_name = Input::get('first_name');
			    $edituser->last_name = Input::get('last_name');
			    $edituser->email = Input::get('email');
			    $password = trim(Input::get('password'));
				if(!empty($password)){
					$edituser->password = $password;
				}
				//remove groups from user
				$userGroups = $edituser->groups()->lists('name');
				// Get the selected groups
				$selectedGroups = array(Input::get('role'));
				$groupsToAdd    = array_diff($selectedGroups, $userGroups);
				$groupsToRemove = array_diff($userGroups, $selectedGroups);
				// Assign the user to groups
				foreach ($groupsToAdd as $groupName){
					if(!empty($groupName)){
				    	$group = Sentry::getGroupProvider()->findByName($groupName);
				    	$edituser->addGroup($group);
					}
				}
				// Remove the user from groups
				foreach ($groupsToRemove as $groupName){
				    $group = Sentry::getGroupProvider()->findByName($groupName);
				    $edituser->removeGroup($group);
				}
				//
				if (!$edituser->save()){
				    alert('Error saving information','danger');
					return Redirect::to('admin/user/'.$id);
				}
			}catch (Cartalyst\Sentry\Users\UserNotFoundException $e){
			    alert('User not found','danger');
				return Redirect::to('admin/user/'.$id);
			}
		}else{
			//new user
			try{
				$edituser = Sentry::createUser(array(
			        'email'    => Input::get('email'),
			        'password' => Input::get('password'),
			        'first_name' => Input::get('first_name'),
			        'last_name' => Input::get('last_name'),
			        'activated' => 1
			    ));
			    //add groups
			    $selectedGroups = array(Input::get('role'));
				// Assign the user to groups
				foreach ($selectedGroups as $groupName){
					if(!empty($groupName)){
				    	$group = Sentry::getGroupProvider()->findByName($groupName);
				    	$edituser->addGroup($group);
					}
				}
				$edituser->save();
			}catch (Cartalyst\Sentry\Users\LoginRequiredException $e){
				alert('Login Field Required','danger');
				return Redirect::to('admin/user');
			}catch (Cartalyst\Sentry\Users\PasswordRequiredException $e){
				alert('Password field is required','danger');
				return Redirect::to('admin/user');
			}catch (Cartalyst\Sentry\Users\UserExistsException $e){
				alert('User with this login already exists','danger');
				return Redirect::to('admin/user');
			}
		}
		alert('User saved successfully');
		//Detect redirect
		$groupSelected = Input::get('role');
		if($groupSelected == 'Admin'){
			return Redirect::to('admin/administrators');
		}else if($groupSelected == 'Partner'){
			return Redirect::to('admin/partners');
		}else{
			return Redirect::to('admin/users');
		}
	}
	
	//USER DELETE
	public function userDelete(){
		$uid = Input::get('uid');
		if($uid > 0){
			//$edituser = Sentry::findUserById($uid);
			$edituser = User::find($uid);
			$edituser->delete();
		}
	}
	
}