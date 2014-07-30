<?php
//Add to list item class to determine if link is active
function menuActive($paths){
	if(!is_array($paths)){
		$paths = array($paths);
	}
	$route = Route::getCurrentRoute()->getPath();
	if(in_array($route, $paths)){
		return 'active';
	}else{
		return '';
	}
}