<?php
class Model_Users extends Model   //модель для работы с таблицей accounts
{
	public function __construct()
	{
		parent::__construct();
		//echo md5('test');
		print_r($_POST);
	}

	function add_user()
	{
		$username = $_POST['username'];
		$password = Hash::create('sha256', $_POST['password'], 'cats do not fliing');
		$email = $_POST['email'];

		echo $username, $password, $email;

		$sth = $this->db->prepare("INSERT INTO accounts (username, password, email) VALUES (:username, :password, :email)");
		$sth->execute(array(
							':username'=>$username,
							':password'=>$password,
							':email'=>$email
							));
		$data = $sth->fetch();
		print_r($data);
		header('location: ../');
	}

	function check_user($username)
	{
		$sth = $this->db->prepare("SELECT username FROM accounts WHERE username = :username");
		$sth->db->execute(array(
								':username' => $userneme
								));

		return false;
	}

	function find_user() //функция авторизации пользователя
	{	
		/*echo Hash::create('sha256', $_POST['password'], 'cats do not fliing');
		die();*/
		//echo "Hello <br/>";
		$sth = $this->db->prepare("SELECT id, username FROM accounts WHERE username = :username  AND password = :password");
   		$sth->execute(array(
							':username'=>$_POST['username'], 
							':password' =>Hash::create('sha256', $_POST['password'], 'cats do not fliing')
   					));

    	/*$result = $sth->fetchAll();
		print_r($result);*/
		$data = $sth->fetch();
		//print_r($data);

		$count = $sth->rowCount();
		if($count > 0)
		{
			//logged in
			Session::init();
			Session::set('username', $data['username'] );
			Session::set('loggedIn', true);
			header('location: ../dashboard');
		}
		else
		{
			header('location: ../login');
		}
		
	}
}