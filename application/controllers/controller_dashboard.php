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
			header('location: ../');
			exit;
		}		
	}

	function action_index()
	{
		$this->view->generate('dashboard_view.php', 'template_view.php');
		//echo YDconnect::get_code();
		$yatoken = Session::get('yatoken');
		if($yatoken != null)
		{
			$yd = new YandexLib;
			$diskClient = $yd -> __construct();
			echo $yd -> show_name($diskClient);
			$yd ->show_dir($diskClient);
		}
	}

	function action_yandex_connect()
	{
		$client_id = "d0387d6c503246909145797d469d7248";
		$client_secret = "576b5cf52f1b4f1bab1eb7eeca1db60f";
		$yatoken = YDconnect::init($client_id,$client_secret); 
		//echo YDconnect::get_code();
		//echo $tocken;
		Session::set('yatoken', $yatoken);
		header('location: ..');
		return $yatoken;
	}

	function action_logout()
	{
		Session::destroy();
		header('location: ..');
		exit;
	}
}
?>