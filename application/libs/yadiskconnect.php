<?php
class YDconnect
{
	//require_once 'libs/phar://yandex-php-library_master.phar/vendor/autoload.php';

	/*public $client_id = "d0387d6c503246909145797d469d7248";
	public $client_secret = "576b5cf52f1b4f1bab1eb7eeca1db60f";*/

	public static function init($client_id, $client_secret)
	{
		//require_once 'libs/phar://yandex-php-library_master.phar/vendor/autoload.php';

	 	/*$client_id = "d0387d6c503246909145797d469d7248";
		$client_secret = "576b5cf52f1b4f1bab1eb7eeca1db60f";*/

		// Если мы еще не получили разрешения от пользователя, отправляем его на страницу для его получения
		// В урл мы также можем вставить переменную state, которую можем использовать для собственных нужд, я не стал
		if (!isset($_GET["code"])) 
		{
   			Header("Location: https://oauth.yandex.ru/authorize?response_type=code&client_id=".$client_id);
    		die();
    	}
  	

		// Если пользователь нажимает "Разрешить" на странице подтверждения, он приходит обратно к нам
		// $_Get["code"] будет содержать код для получения токена. Код действителен в течении часа.
		// Теперь у нас есть разрешение и его код, можем отправлять запрос на токен
		function postKeys($url,$peremen,$headers)
		{
    		$post_arr=array();
    		foreach ($peremen as $key=>$value)
    		{
        		$post_arr[]=$key."=".$value;
        	}
   			$data=implode('&',$post_arr);
    
	    	$handle=curl_init();
	    	curl_setopt($handle, CURLOPT_URL, $url);
	    	curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
	    	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
	    	curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
	    	curl_setopt($handle, CURLOPT_POST, true);
	    	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	    	curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
	    	$response=curl_exec($handle);
	    	$code=curl_getinfo($handle, CURLINFO_HTTP_CODE);
	    	return array("code"=>$code,"response"=>$response);
    	}

    	$result = postKeys("https://oauth.yandex.ru/token",
		  			array(
			       			'grant_type'=> 'authorization_code', // тип авторизации
			       			'code'=> $_GET["code"], // наш полученный код
			       			'client_id'=>$client_id,
			       			'client_secret'=>$client_secret
			    	),
				    array('Content-type: application/x-www-form-urlencoded')
				    );

		if ($result["code"]==200) 
		{
	    	$result["response"]=json_decode($result["response"],true);
	    	$token=$result["response"]["access_token"];
	    	//echo "Your token" .$token ."<br/>";
	    	return $token;
	    }
	    else
	    {
	   		//echo "Какая-то фигня! Код: ".$result["code"];
	   		return $result["code"];
	    }

	// Токен можно кинуть в базу, связав с пользователем, например, а за пару дней до конца токена напомнить, чтобы обновил
	   
	}
}