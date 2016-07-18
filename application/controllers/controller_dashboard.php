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
		$this->view->title = 'Dashboard';
		$this->view->generate('dashboard_view.php', 'template_view.php');
		//echo YDconnect::get_code();
		$yatoken = Session::get('yatoken');
		if($yatoken != null)
		{
			$yandex = new Yandex();
			$yandex->show_content($yatoken);
			$yandex->get_space_info($yatoken);

			//$yd = new YandexLib;
			//$diskClient = $yd -> __construct();
			//$ses = $yd ->show_name($diskClient);
			//Session::set('dirContent',$yd ->show_name($diskClient));
			//echo $yd -> show_name($diskClient);
			//Session::set('dirContent', $yd ->show_dir($diskClient));
			//Session::set('diskSpace', $yd ->disk_space($diskClient));


			//exit;
			//Session::set('dirContent', $yd ->show_dir($diskClient));
		}
		$dropbox = new Dropbox();
		$dropbox->show_content('Q1k4cCEvitwAAAAAAAAH2IFMjFpk0b5gtN9RcJMyk9xeB00apxwmGQGSyqvitto0');
	}


	function action_yandex_connect()
	{
		$client_id = "d0387d6c503246909145797d469d7248";
		$client_secret = "576b5cf52f1b4f1bab1eb7eeca1db60f";
		$yatoken =Yandex::connect($client_id, $client_secret);
		//$yatoken = YDconnect::init($client_id,$client_secret);
		//echo YDconnect::get_code();
		//echo $tocken;
		Session::set('yatoken', $yatoken);
		header('location: ..');
		return $yatoken;
	}

	function action_yandex_crdir()
	{
		$yatoken = Session::get('yatoken');
		//$yd = new YandexLib;
		//$diskClient = $yd -> __construct();
		$path = $_POST['path'];
		//$yd->create_dir($diskClient, $path);
		$yandex = new Yandex();
		$yandex->create_dir($yatoken, $path);
		header('location: ..');
	}

	function action_yandex_upload()
	{
		$yatoken = Session::get('yatoken');
		$yandex = new Yandex();

		//$yd = new YandexLib;
		//$diskClient = $yd -> __construct();
		$fileName = $_FILES['filename']['name'];
		$yandex->upload_file($yatoken, $_FILES['filename']);
	//	print_r(is_uploaded_file ($_FILES['filename']['tmp_name']));
		//$yd -> upload_file($diskClient, $_FILES['filename']);
		header('location: ..');
		//print_r($_FILES['filename']['name']);

	}

function action_yandex_download()
	{
		$yatoken = Session::get('yatoken');
		$yandex = new Yandex();
		$yandex->download_file($yatoken, 'Otvety.pdf');
		//$yd = new YandexLib;
		//$diskClient = $yd -> __construct();
		//$yd -> download_file($diskClient, $_POST['dwnpath']);
	}



	function action_logout()
	{
		Session::destroy();
		header('location: ..');
		exit;
	}
}
?>