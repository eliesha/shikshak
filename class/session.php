<?php

/**
 * 
 */
class Session extends Database{
	public function setKeyValue($key, $value){
		if (!isset($_SESSION)) {
			session_start();
		}
		$_SESSION[$key] = $value;
	}
	public function getSessionByKey($key){
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		} else {
			return null;
		}
	}
	public function destroySession(){
		if (isset($_SESSION)) {
			session_destroy();
		}
	}
}