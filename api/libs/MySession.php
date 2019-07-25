<?php
/**
*
*/
session_start();
class MySession
{
	public function __construct()
	{
		self::$instance =& $this;
	}
	private static $instance;

	public function set_userdata($data, $value = NULL)
	{
		if (is_array($data))
		{
			foreach ($data as $key => &$value)
			{
				$_SESSION[$key] = $value;
			}

			return;
		}

		$_SESSION[$data] = $value;
	}

	// unsetting user sessions
	public function unset_userdata($key){
		if (is_array($key)){
			foreach ($key as $k){
				unset($_SESSION[$k]);
			}
			return;
		}
		unset($_SESSION[$key]);
	}

	// Check if session exists
	public function has_userdata($key){
		return isset($_SESSION[$key]);
	}
	// Fecthing use sessions
	public function userdata($key = NULL){
		if (isset($key)){
			return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
		}
		elseif (empty($_SESSION)){
			return array();
		}
	}

	public function sess_destroy()
	{
		session_destroy();
	}
	
}
