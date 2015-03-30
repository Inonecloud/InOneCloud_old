<?php
class DBconnect extends PDO  //подключение к базе данных
{
	/*$user = 'root';
	$pass = '';*/
	public function __construct()
	{
		parent::__construct(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
		//parent::__construct('mysql:host=127.0.0.1; dbname = inonecloud', DB_USER, DB_PASS);
	}
}
//$connect = new DBconnect();
/*try{
	$db = new PDO('mysql:host=127.0.0.1; dbname = inonecloud', 'root');
}catch (PDOException $e){
		echo "ggg" . $e->getMessage();
		exit;
}

$sql = 'SELECT id FROM accounts';
$rs = $db->query($sql);

/*$rows = $rs->fetchAll(PDO::FETCH_OBJ);
print_r($rows);*/

