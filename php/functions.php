<?php

function validate_phone_number($phone_number){
	if(count(str_split((string)((int)($phone_number)))) == 10){
		return True;
	}else{
		return False;
	}
}

function unique_phone_number($data, $phone_number){
	global $database;
	
	if(strlen(trim((string)($phone_number))) > 0){
		$chk = $database->select_table(3, "id", "members", "$data = $phone_number");
		$chk = $chk->fetchAll();
		if(count($chk) < 1){
			return True;
			
		}else{
			return False;
		}
	}else{
		return False;
	}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function validate_text_input($post_name){
	$Err = '';
	if (empty($_POST[$post_name])) {
		$Err = " $post_name is required.";
	} else {
		$var = test_input($_POST[$post_name]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$var)) {
		  $Err = " Only letters and white space allowed."; 
		}
	}
	return $Err;
}
function validate_var_input($post_name){
	$Err = '';
	if (empty($_POST[$post_name])) {
		$Err = " $post_name is required.";
	} else {
		$var = test_input($_POST[$post_name]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z0-9]*$/",$var)) {
		  $Err = " Only letters and white space allowed."; 
		}
	}
	return $Err;
}
function validate_number_input($post_name){
	$Err = '';
	if (empty($_POST[$post_name])) {
		$Err = " $post_name is required.";
	} else {
		$var = test_input($_POST[$post_name]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[0-9]*$/",$var)) {
		  $Err = " Only numbers allowed."; 
		}
	}
	return $Err;
}
function validate_group_input($post_name){
	$Err = '';
	if (empty($_POST[$post_name])) {
		$Err = " $post_name is required.";
	} else {
		$var = test_input($_POST[$post_name]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z]*$/",$var)) {
		  $Err = " Only letters allowed."; 
		}
		if(!strlen(trim($var)) == 1) $Err = " Invalid Group.";
	}
	return $Err;
}