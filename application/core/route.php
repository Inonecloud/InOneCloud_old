<?php
class Route    //маршрутизация по сайту
{
	static function start()
	{
		//контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
		//$routes = explode('/', substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "?")));
		if(strpos($_SERVER['REQUEST_URI'], "?") == true)
			$routes = explode('/', substr($_SERVER['REQUEST_URI'], 0 , strpos($_SERVER['REQUEST_URI'], "?")));
		else
			$routes = explode('/',$_SERVER['REQUEST_URI']);
		
		//print_r($routes);
		//die();

		//получаем имя контроллера
		if(!empty($routes[1]))
		{
			//$routes[1] = substr($routes[1], 0, strpos($routes[1], "?"));
			$controller_name = $routes[1];
		}
		
		//print_r($controller_name);
			//die();
		//получаем имя экшена
		if(!empty($routes[2]))
		{
			$action_name = $routes[2];
		}

		//добавляем префиксы
	//	$model_name = 'Model_' . $controller_name;
		$controller_name = 'Controller_' . $controller_name;
		$action_name = 'action_' . $action_name;
		
		/*$controller = new $routes[1];
		$controller -> load_model($routes[1]);*/
		

		//подключаем файл с классом модели
		/*$model_file = strtolower($model_name). '.php';
		$model_path = "application/models/" . $model_file;
		if(file_exists($model_path))
		{
			include "application/models/" . $model_file;
		}*/

		//подключаем файл с классом контоллера
		$controller_file = strtolower($controller_name) . '.php';
		$controller_path = "application/controllers/" . $controller_file;
		if(file_exists($controller_path))
		{
			include "application/controllers/" . $controller_file;
		}
		else
		{
			Route::ErrorPage404();
		}

		//создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;

		if(method_exists($controller, $action))
		{
			$controller->$action();	//вызываем действие контроллерра
		}
		else
		{
			Route::ErrorPage404();	// если контроллер запрашиваемой страницы не найден, то переброс на 404
		}
	}

	static function ErrorPage404()
	{
		$host = 'http://' . $_SERVER['HTTP_HOST'].'/';
		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
	}
}
?>