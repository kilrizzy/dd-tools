<?php

class SentryTableSeeder extends Seeder {

	public function run()
	{
		//Create admin user
		Sentry::getUserProvider()->create(array(
	        'email'       => 'admin@admin.com',
	        'password'    => "admin",
	        'first_name'  => 'Admin',
	        'last_name'   => 'User',
	        'activated'   => 1,
	    ));

	    //Create admin group
	    Sentry::getGroupProvider()->create(array(
	        'name'        => 'Admin',
	        'permissions' => array('admin' => 1),
	    ));

	    // Assign user permissions
	    $adminUser  = Sentry::getUserProvider()->findByLogin('admin@admin.com');
	    $adminGroup = Sentry::getGroupProvider()->findByName('Admin');
	    $adminUser->addGroup($adminGroup);
	    
	}

}
