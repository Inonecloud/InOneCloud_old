<?php
class Controller_Login extends Controller
{
	function __construct()
	{
		parent::__construct();
		//$this->model = new Model_Users();
		//$this->view = new View();
	}

	/*function action_find_user()
	{
		//$this->model = find_user();
		$usersModel = $this->load_model('users');
		$usersModel->find_user(htmlentities($_POST['username']));

	}*/

	/**
	 * This method login user, if it's account exist
     */
	function action_find_user(){
		$usersModel = $this->load_model('users');
		if (!($usersModel->check_user(htmlentities($_POST['username'])))) {
			$usersModel->find_user(htmlentities($_POST['username']));
		} else {
			error_log("This user not exist");
			echo "User not exist";
		}
	}
	function action_index()
	{
		$this->view->generate('main_view.php', 'template_view.php');
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
