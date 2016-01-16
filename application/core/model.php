<?php
class Model   //модель по умолчанию
{
	function __construct()
	{
		$this->db = new DBconnect();
                $this->db->exec("set names utf8");
	}

	public function get_data()
	{
		
	}
}
