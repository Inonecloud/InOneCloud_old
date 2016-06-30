<?php

/**
 * Class Controller
 *
 * Created by Andrew Yelmanov
 *
 * Date: 22.03.2015
 */
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

	/**
	 * Loading user model
	 *
	 * @param string $name
	 * @return mixed
     */
	public function load_model($name)	//функция загрузки модели
	{
		$path = $_SERVER['DOCUMENT_ROOT'].'/application/models/model_'.$name .'.php';	//имя файла model_имямодели.php

		if(file_exists($path))
		{
			require $_SERVER['DOCUMENT_ROOT'].'/application/models/model_'.$name .'.php';
			//require '../models/model_'.$name .'.php';		// подключаем его
			$model_name = 'Model_'.$name;	
			//$this->model = new $model_name();	//создаем объект класса Model_имякласса
			return new $model_name();
		}
	}
}
?>