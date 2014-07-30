<?php

class DashboardController extends BaseController {
	
	//CONTENTS DISPLAY
	public function dashboardDisplay()
	{
		global $user,$data_list;
		return View::make('dashboard/dashboard',array('data_list'=>$data_list));
	}
}