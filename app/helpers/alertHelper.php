<?php
//success/info/warning/danger
//Make a library for this - BootAlerts
function alert($message, $type='success'){
	$alerts = Session::get('alerts', array());
	//Check if alert exists
	$exists = false;
	foreach($alerts as $a){
		if($a['message'] == $message && $a['type'] == $type){
			$exists = true;
		}
	}
	//add alert
	if(!$exists){
		$alerts[] = array('message'=>$message,'type'=>$type);
		Session::put('alerts', $alerts);
	}
}

function alerts_exist(){
	$alerts = Session::get('alerts', array());
	if(count($alerts) > 0){
		return true;
	}else{
		return false;
	}
}

function alerts_get($remove = true){
	$alerts = Session::get('alerts', array());
	if($remove){
		Session::put('alerts', array());
	}
	return $alerts;
}

function alerts_clear(){
	Session::put('alerts', array());
}