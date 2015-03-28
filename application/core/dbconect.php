<?php
class DBconnect extends PDO
{
	private $host = 'localhost';
	private $dbname = 'inonecloud';
	private $user = "inonecloud_user";
	private $pass = "1q2w3e!Q@W#E";
	function __construct()
	{
		$pdo = new PDO('mysql:dbname=inonecloud; host=localhost', $this->$user, $this->$pass);
	}
}
