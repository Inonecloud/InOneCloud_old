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
		echo md5('test');
	}
	function add_user()
	{
		
	}
	function find_user()
	{
		$sth = $this->db->prepare("SELECT * FROM accaunts WHERE usermame = :username  and password = :password");
		$sth->execute(array(
							':username'=>$_POST['username'], 
							':password' => $_POST['password']
						));
		$data = $sth->fetchAll();
		print_r($data);
	}
}