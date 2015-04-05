<?php
class Controller_Registration extends Controller
{
	function action_index()
	{
		$this->view->generate('registration_view.php', 'template_view.php');
	}
		function action_add_user()
	{
		//$this->model = find_user();
		$usersModel = $this->load_model('Users');
		$usersModel->add_user();

	}
}