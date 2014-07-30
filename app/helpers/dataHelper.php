<?php
global $data_list;
$data_list = array();

$data_list['roles'] = array(
	'' => 'Basic User',
	'Admin' => 'Administrator',
);
//
$data_list['states'] = array(
	'AL'=>"Alabama",  
	'AK'=>"Alaska",  
	'AZ'=>"Arizona",  
	'AR'=>"Arkansas",  
	'CA'=>"California",  
	'CO'=>"Colorado",  
	'CT'=>"Connecticut",  
	'DE'=>"Delaware",  
	'DC'=>"District Of Columbia",  
	'FL'=>"Florida",  
	'GA'=>"Georgia",  
	'HI'=>"Hawaii",  
	'ID'=>"Idaho",  
	'IL'=>"Illinois",  
	'IN'=>"Indiana",  
	'IA'=>"Iowa",  
	'KS'=>"Kansas",  
	'KY'=>"Kentucky",  
	'LA'=>"Louisiana",  
	'ME'=>"Maine",  
	'MD'=>"Maryland",  
	'MA'=>"Massachusetts",  
	'MI'=>"Michigan",  
	'MN'=>"Minnesota",  
	'MS'=>"Mississippi",  
	'MO'=>"Missouri",  
	'MT'=>"Montana",
	'NE'=>"Nebraska",
	'NV'=>"Nevada",
	'NH'=>"New Hampshire",
	'NJ'=>"New Jersey",
	'NM'=>"New Mexico",
	'NY'=>"New York",
	'NC'=>"North Carolina",
	'ND'=>"North Dakota",
	'OH'=>"Ohio",  
	'OK'=>"Oklahoma",  
	'OR'=>"Oregon",  
	'PA'=>"Pennsylvania",  
	'RI'=>"Rhode Island",  
	'SC'=>"South Carolina",  
	'SD'=>"South Dakota",
	'TN'=>"Tennessee",  
	'TX'=>"Texas",  
	'UT'=>"Utah",  
	'VT'=>"Vermont",  
	'VA'=>"Virginia",  
	'WA'=>"Washington",  
	'WV'=>"West Virginia",  
	'WI'=>"Wisconsin",  
	'WY'=>"Wyoming"
);

$data_list['states_abbrev'] = array();
foreach($data_list['states'] as $k => $v){
	$data_list['states_abbrev'][$k] = $k;
}
//
$data_list['yes_no'] = array('Yes'=>'Yes','No'=>'No');
//
$data_list['ability_scores'] = array(
	'str' => 'Strength',
	'con' => 'Constitution',
	'dex' => 'Dexterity',
	'int' => 'Intelligence',
	'wis' => 'Wisdom',
	'cha' => 'Charisma',
);
$data_list['defenses'] = array(
	'ac' => 'Armor Class',
	'fort' => 'Fortitude',
	'ref' => 'Reflex',
	'wil' => 'Willpower',
);
/*
--
FUNCTIONS
--
*/
//Convert string of comma-separated items for an array
function prepStringForArray($string,$unique=false){
	$array = explode(',',$string);
	foreach($array as $k=>$v){
		$array[$k] = trim($v);
	}
	if($unique){
		$unique_keys = array();
		foreach($array as $k=>$v){
			$unique_key = prepKey($v);
			if(!in_array($unique_key,$unique_keys)){
				$unique_keys[] = $unique_key;
			}else{
				unset($array[$k]);
			}
		}
	}
	return $array;
}
//Lower and remove spaces
function prepKey($string){
	$string = strtolower($string);
	$string = str_replace(' ', '', $string);
	return $string;
}