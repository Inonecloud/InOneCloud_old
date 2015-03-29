<?php
class Controller	//контроллер по умолчанию
{
	public $model;
	public $view;

	function __construct()
	{
		$this->view = new View();
	}

	function action_index()
	{
		
	}
}
?>