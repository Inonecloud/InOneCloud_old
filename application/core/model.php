<?php
/**
 * Class Model
 * Model by default. Only create a new connection with database
 *
 * @author Andrew Yelmanov
 * Date: 22.03.2015
 */
class Model{   //модель по умолчанию
	function __construct()
	{
		$this->db = new DBconnect();
                $this->db->exec("set names utf8");
	}

	public function get_data()
	{
		
	}
}
