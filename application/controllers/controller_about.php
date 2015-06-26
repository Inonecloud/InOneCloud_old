<?php
class Controller_About extends Controller
{
	function action_index()
	{
		$this->view->title = 'About';
		$this->view->generate('about_view.php', 'template_view.php');
	}
}