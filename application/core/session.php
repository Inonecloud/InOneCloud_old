<?php
class Session    //cессии
{
	public static function init()	//инициализация сессии
	{
		session_start();
	}

	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	public static function get($key)
	{
		if (isset($_SESSION[$key]))
		return $_SESSION[$key];
	}	

	public static function destroy()	//закрытие сессии
	{
		session_destroy();
	}
}