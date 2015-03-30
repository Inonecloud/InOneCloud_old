<?php
//require_once 'application/core/dbconnect.php';
/*try{
	$pdo = new PDO('mysql:host=127.0.0.1; dbname=inonecloud', 'root','');
}catch (PDOExeption $e)
{
	die("Error: ".$e->getMessage());
}*/
	//exit('fuck');
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
		
	}
	function find_user()
	{
		echo "Hello <br/>";
		$sth = $this->db->prepare("SELECT * FROM accounts");
		//$sth = $this->db->prepare("SELECT * FROM accounts WHERE username = :username  AND password = :password");
		//$sth->execute(array(
							//':username'=>$_POST['username'], 
							//':password' => $_POST['password']
						//));
		$data = $sth->fetchAll();
		print_r($data);
	}
}