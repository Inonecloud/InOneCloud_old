<?php
class DBconnect extends PDO  //подключение к базе данных НЕТРОГАТЬ, ОНО КАК-ТО РАБОТАЕТ
{
	public function __construct()
	{
		parent::__construct(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
		//parent::__construct('mysql:host=127.0.0.1; dbname = inonecloud', DB_USER, DB_PASS);
	}
}


