<?php
class Controller_Login extends Controller
{
	function __construct()
	{
		parent::__construct();
		//$this->model = new Model_Users();
		$this->view = new View();
	}

	function action_find_user()
	{
		//$this->model = find_user();
		$usersModel = $this->load_model('Users');
		$usersModel->find_user();

	}
	function action_index()
	{
		/*if(isset($_POST['LogIn']))
		{
			if(isset($_POST['login']) && (isset($_POST['password'])) )
			{
				$login = $_POST['login'];
				$password = $POST['password']; 

			//проверка имени пользователя и пароля
			}
		}
		else
		{
			echo "Input your login and password in input fields";
		}*/

	}
}