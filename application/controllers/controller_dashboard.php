<?php
class Controller_Dashboard extends Controller
{
	function __construct()
	{
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		$username = Session::get('username');
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
		//echo YDconnect::get_code();
	}

	function action_yandex_connect()
	{
		$client_id = "d0387d6c503246909145797d469d7248";
		$client_secret = "576b5cf52f1b4f1bab1eb7eeca1db60f";
		echo YDconnect::init($client_id,$client_secret); 
		echo "hello";
		//echo YDconnect::get_code();
		//echo $tocken;

	}

	function action_logout()
	{
		Session::destroy();
		header('location: ../login');
		exit;
	}
}
?>