<?php
class Model_Articles extends Model //Модель для работы с таблицей Articles
{
	public function __construct()
	{
		parent::__construct();
		print_r($POST);
	}

	function show_article()
	{
		$sth = $this->db->prepare("SELECT article FROM articles WHERE id = :id");//SQL Query
		$sth->execute(array(
							 ':id' => $id
							));
	}
}