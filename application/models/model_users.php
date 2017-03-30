<?php

/**
 * Class Model_Users
 * This class works with table accounts in a database
 *
 * @author Andrew Yelmanov
 * Data 28.03.2015
 */
class Model_Users extends Model{   //модель для работы с таблицей accounts

	public $username;

	public function __construct()
	{
		parent::__construct();
		//echo md5('test');
		print_r($_POST);
	}

	/**
	 * Take salt from database
	 * @access private
	 *
	 * @param string $username
	 * @return mixed
     */
	private function take_salt($username)
	{
	    $sth = $this->db->prepare("SELECT salt FROM accounts WHERE username = :username");
	    $sth->execute(array(
	                        ':username'=>$username
	                        ));
	    $salt = $sth->fetch();
		print_r($salt);
	    return $salt;    
	}

	/**
	 * Add a new user in database
     */
	public function add_user()
	{
		$username = htmlentities($_POST['username']);
		$salt = Hash::salt();
		$password = Hash::create('sha256', htmlentities($_POST['password']), $salt);
		$email = htmlentities($_POST['email']);
		
		echo $username, $password, $email;
		if($this->check_user($username) == true)
		{
			$sth = $this->db->prepare("INSERT INTO accounts (username, password, salt, email) VALUES (:username, :password, :salt, :email)");
			$sth->execute(array(
								':username'=>$username,
								':password'=>$password,
								':salt'=>$salt,
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
	/**
	 * Change user status into database
	 *
	 * @param $username
     */
	function activate_user($username) //активация аккаунта пользователя
	{
		$sth = $this->db->prepare("UPDATE accounts SET status = 1 WHERE username = :username");
		$sth->execute(array(
							':username' =>$username 
						));
	}

	/**
	 * Check user account for existing
	 *
	 * @param string $username
	 * @return bool
     */
	public function check_user($username)	//проверка на существование пользователя (функцию необходимо проверить)
	{
		$sth = $this->db->prepare("SELECT username FROM accounts WHERE username = :username");
		$sth->execute(array(
								':username' => $username
							));
		
		$count = $sth ->rowCount();

		if($count > 0)
			return false;
		else
			return true;
	}

	/**
	 * Check account status. Status takes from database
	 * @access private
	 *
	 * @param string $username
	 * @return bool
     */
	private function check_activation($username)
	{
		$sth = $this->db->prepare("SELECT username, status FROM accounts WHERE username = :username");
		$sth->execute(array(
								':username' => $username
							));
		$row = $sth->fetch();
		if($row['status'] == 0)
			return false;
		else
			return true;
	}

	/**
	 * This method find user in database and redirect user to dashboard
	 *
	 * @param string $username
     */
	function find_user($username) //функция авторизации пользователя
	{	
		/*echo Hash::create('sha256', $_POST['password'], 'cats do not fliing');
		die();*/
		
		//$username = htmlentities($_POST['username']);
		$salt = $this -> take_salt($username);
		$pass = Hash::create('sha256',htmlentities($_POST['password']), $salt[0]);
		//print_r($pass);
		//die();

		$sth = $this->db->prepare("SELECT id, username FROM accounts WHERE username = :username  AND password = :password");
   		$sth->execute(array(
							':username'=>htmlentities($_POST['username']),
							':password' =>Hash::create('sha256', htmlentities($_POST['password']), $salt[0])
   					));

    	/*$result = $sth->fetchAll();
		print_r($result);*/
		$data = $sth->fetch();
		//print_r($data);

		$count = $sth->rowCount();
		if($count > 0)
		{
			if($this->check_activation($username)) {
				//logged in
				Session::init();
				Session::set('username', $data['username']);
				Session::set('loggedIn', true);
				header('location: ../dashboard');
			} else {
				error_log("Error: Non active user tried to authorize in application", 0);
				Session::destroy();
			}
		}
		else
		{
			header('location: ../login');
			error_log("Error: User $username is not exist or password $pass is not good");
		}
	}
}