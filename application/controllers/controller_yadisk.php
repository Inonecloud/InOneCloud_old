<?php

class Controller_Yadisk extends Controller
{
	function __construct()
	{
		parent::__construct();
	}
	function action_index()
	{
		$this->view->generate('about_view.php', 'template_view.php');
	}
}