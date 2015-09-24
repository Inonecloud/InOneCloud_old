<?php
class Controller_404 extends Controller
{
	function action_index()
	{
		$this->view->title = "404";
		$this->view->generate('404_view.php', 'template_view.php');
	}

}
