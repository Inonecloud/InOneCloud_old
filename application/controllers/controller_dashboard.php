<?php
class Controller_Dashboard extends Controller
{
	function __construct()
	{
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		if($logged == false)
		{
			Session::destroy();
			header('location: ../login');
			exit;
		}
		
	}

	function action_index()
	{
		$this->view->generate('dashboard_view.php', 'template_view.php');
	}

	function action_logout()
	{
		Session::destroy();
		header('location: ../login');
		exit;
	}
}
?>