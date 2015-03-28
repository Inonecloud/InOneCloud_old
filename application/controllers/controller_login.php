<?php
class Controller_Login extends Controller
{
	function action_index()
	{
		if(isset($_POST['login']) && (isset($_POST['password'])) )
		{
			$login = $_POST['login'];
			$password = $POST['password']; 

			//проверка имени пользователя и пароля
		}
	}
}