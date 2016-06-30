<?php
CLass DBconect
{
	protected static $db = null;

	private function __construct()
	{
		
	}

	public static function getInstance()
	{
		if (self::$db == null)
		{
			self::$db = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
		}
		return self::$db;
	}

}