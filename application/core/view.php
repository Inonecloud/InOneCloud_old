<?php
class View
{
	//public $temlate_view //вид по умолчанию

	function generate($content_view, $template_view, $data = null)
	{
		include 'application/views/'.$template_view;
	}
}
?>