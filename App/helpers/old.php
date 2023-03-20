<?php


function old($name = '', $value = ''){
	if(!empty($name) and !empty($value)){
		if(!isset($_SESSION[$name])){
			$_SESSION[$name] = $value;		
		}
	}

	if(!empty($name) and empty($value)){
		if(isset($_SESSION[$name])){
			$old_value = $_SESSION[$name];
			unset($_SESSION[$name]);		
			return $old_value;
		}
	}
}