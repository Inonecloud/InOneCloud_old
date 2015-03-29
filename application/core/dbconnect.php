<?php
class DBconnect extends PDO   //подключение к базе данных
{
	public function __construct()
	{
		parent::__construct('mysql:host=localhost; dbname = inovecloud', 'root', '');
	}
}
