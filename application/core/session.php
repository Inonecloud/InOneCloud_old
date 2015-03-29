<?php
class Session    //cессии
{
	public static function inti()	//инициализация сессии
	{
		session_start();
	}

	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	public static function get($key)
	{
		return $_SESSION[$key];
	}	

	public static function destroy()	//закрытие сессии
	{
		session_destroy();
	}
}