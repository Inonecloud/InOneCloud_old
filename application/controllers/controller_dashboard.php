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
        $gtoken = Session::get('gtoken');
        $dtoken = Session::get('gtocken');
        if ($yatoken != null) {
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

        if ($dtoken != null) {
            //Dropbox debug

            $dropbox = new Dropbox();
            $dropbox->show_content('Q1k4cCEvitwAAAAAAAAH2IFMjFpk0b5gtN9RcJMyk9xeB00apxwmGQGSyqvitto0');
            $dropbox->get_space_info('Q1k4cCEvitwAAAAAAAAH2IFMjFpk0b5gtN9RcJMyk9xeB00apxwmGQGSyqvitto0');

        }

        if ($gtoken != null) {
            // Google debug

             $google = new Google();
             $google->show_content($gtoken);
        }
    }

    public function action_yandex_connect():string{
        $client_id = "d0387d6c503246909145797d469d7248";
        $client_secret = "576b5cf52f1b4f1bab1eb7eeca1db60f";
        try{
            $yatoken =Yandex::connect($client_id, $client_secret);
            Session::set('yatoken', $yatoken);
            header('location: ..');
        } catch(Exception $e){
            error_log("Can't connect to Yandex Disk");
        }
        return $yatoken;
    }

    /**
     * This function connect to Google Drive
     *
     * @return string
     */

    public function action_google_connect():string {
        $client_id = "135842521742-l0793cjhtc3k2sh5gng2q34r3i8iv13h.apps.googleusercontent.com";
        $client_secret = "g6UZFhKVCZXz2Y7gZTVreRD5";
        try{
            $gtoken = Google::connect($client_id, $client_secret);
            Session::set('gtocken', $gtoken);
        }  catch (Exception $e){
            error_log("Can't connect to Google Drive");
        }
        return $gtoken;
    }
    /**
     * This function connect to Dropbox
     *
     * @return string
     */
    public function action_dropbox_connect():string {
        $client_id = "135842521742-l0793cjhtc3k2sh5gng2q34r3i8iv13h.apps.googleusercontent.com";
        $client_secret = "g6UZFhKVCZXz2Y7gZTVreRD5";
        try{
            $dtoken = Dropbox::connect($client_id, $client_secret);
            Session::set('dtocken', 'Q1k4cCEvitwAAAAAAAAH2IFMjFpk0b5gtN9RcJMyk9xeB00apxwmGQGSyqvitto0');
        }  catch (Exception $e){
            error_log("Can't connect to Google Drive");
        }
        return $dtoken;
    }

	function action_yandex_crdir()
	{
		$yatoken = Session::get('yatoken');
		//$yd = new YandexLib;
		//$diskClient = $yd -> __construct();
		$path = $_POST['path'];
		//$yd->create_dir($diskClient, $path);
		//$yandex = new Yandex();
		//$yandex->create_dir($yatoken, $path);
		$dropbox = new Dropbox();
		$dropbox->delete_file_dir('Q1k4cCEvitwAAAAAAAAH2IFMjFpk0b5gtN9RcJMyk9xeB00apxwmGQGSyqvitto0', $path);
		//$dropbox->create_dir('Q1k4cCEvitwAAAAAAAAH2IFMjFpk0b5gtN9RcJMyk9xeB00apxwmGQGSyqvitto0', $path);
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