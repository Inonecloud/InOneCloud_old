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
		if($this->check_user($username) == true)
		{
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
		else
			echo "Change Username";
	}

	//Необходимо проверить эту функцию
	function activate_user($username) //активация аккаунта пользователя
	{
		$sth = $this->db->prepare("UPDATE accounts SET activate = 1 WHERE username = :username");
		$sth->execute(array(
							':username' =>$username 
							));

	}

	function check_user($username)	//проверка на существование пользователя (функцию необходимо проверить)
	{
		$sth = $this->db->prepare("SELECT username FROM accounts WHERE username = :username");
		$sth->execute(array(
								':username' => $username
								));
		
		$count = $sth ->rowCount();
		//echo $count;
		//exit;
		if($count > 0)
			return false;
		else
			return true;
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