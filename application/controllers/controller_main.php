<?php
class Controller_Main extends Controller
{
	function __construct()
	{
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		$username = Session::get('username');
		if($logged ==true)
		{
			header('location: ../dashboard');
			exit;
		}		
	}

	function action_index()
	{
		$this->view->generate('main_view.php', 'template_view.php');
	}
}
?>