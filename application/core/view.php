<?php
/**
 * Class View
 *
 * Created by Andrew Yelmanov
 *
 * Date: 22.03.2015
 */
class View{
	//public $temlate_view //вид по умолчанию

	function generate($content_view, $template_view, $data = null)
	{
		include 'application/views/'.$template_view;
	}
}
?>