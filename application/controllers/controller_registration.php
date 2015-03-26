<?php
class Controller_Registration extends Controller
{
	function action_index()
	{
		$this->view->generate('registration_view.php', 'template_view.php');
	}
}