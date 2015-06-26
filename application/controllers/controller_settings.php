<?php
class Controller_Settings extends Controller
{
	function action_index()
	{
		$this->view->title = 'Settings';
		$this->view->generate('settings_view.php', 'template_view.php');
	}
}