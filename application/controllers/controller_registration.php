<?php
class Controller_Registration extends Controller
{
	function action_index()
	{
		$this->view->title = 'Create account';
		$this->view->generate('registration_view.php', 'template_view.php');
	}
		function action_add_user()
	{
		//$this->model = find_user();
		$choices = array('en', 'de', 'ru');
		$email = filter_input(INPUT_POST, 'email', 'FILTER_VALIDATE_EMAIL');
		if ($email === false){
			print "Submittet email address is invalid";
		} else {
			if (filter_has_var(INPUT_POST, 'agree')) {


				$usersModel = $this->load_model('users');
				$usersModel->add_user();
			}
		}
	}

	function action_subscribe()
	{
		if(isset($_POST['testemail']))
		{
			$us_email = $_POST['testemail'];
			$to = 'andrew@elmanov.ru';
			$subject = 'InOneCloud Tester';
			$message = "Hello Andrew,\nI want to test InOneCloud. \n Please add me to testers via Email: $us_email";
			$is_sended = mail($to, $subject, $message);
				if($is_sended)
				{
					header('location: ..');
					return "Ok";
				}
				else
				{
					header('location: ..');
					return "Try again later";
				}
		}
	}
}