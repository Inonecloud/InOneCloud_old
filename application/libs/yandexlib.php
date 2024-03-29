<?php
use Yandex\Disk\DiskClient;
class YandexLib
{
	function __construct()
	{
		$tocken = Session::get('yatoken');
		$diskClient = new DiskClient();
		//Устанавливаем полученный токен
		$diskClient->setAccessToken($tocken);
		$diskClient->setServiceScheme(DiskClient::HTTPS_SCHEME);
		return $diskClient;
	}

	/**
	 * @param $url
	 * @param $var
	 * @param $headers
	 * @return array
     */
	private function prepare_request($url, $var, $headers)
	{
		$handle = curl_init();
		curl_setopt($handle, CURLOPT_URL, $url);
		curl_setopt($handle, CURLOPT_PUT, true);
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
		return array("code"=>$code,"response"=>$response);
	}

	public function show_content()
	{
		$result = prepare_request("webdav.yandex.ru",
									array(

									),
									array('Content-type: application/binary'));
	}

	function show_name($diskClient)
	{
		return $login = $diskClient->getLogin();
	}

	function disk_space($diskClient)
	{
		//Получаем свободное и занятое место
		return $diskSpace = $diskClient->diskSpaceInfo();
	}

	function show_dir($diskClient)
	{
		return $dirContent = $diskClient->directoryContents('/');
		
		//print_r($files);
		


		/*foreach ($dirContent as $dirItem) 
		    if ($dirItem['resourceType'] === 'dir') 
		        echo 'Directory "'. $dirItem['displayName'] . date(
		                'Y-m-d в H:i:s',
		                strtotime($dirItem['creationDate'])
		            ) . '<br/>';
		     else 
		        echo 'File "' . $dirItem['displayName'] . '" Size ' . $dirItem['contentLength'] . ' bytes '.$dirItem['public_url'] . date(
		                'Y-m-d в H:i:s',
		                strtotime($dirItem['creationDate'])
		            ) . '<br />';   */
		
	}

	function create_dir($diskClient, $path)
	{
		$dirContent = $diskClient->createDirectory($path);
		if ($dirContent)
		{
    		echo 'Создана новая директория "' . $path . '"!';
		}
	}

	function upload_file($diskClient, $fileName)
	{
		//$fileName = 'My_video_1.avi';
		$newName = 'My_file.txt';
		//echo $newName;
		print_r($fileName);
		print_r($_FILES);

		//exit;
		$diskClient->uploadFile(
		    '/Загрузки/',
		    array(
		        'path' => $fileName['tmp_name'],
		        'size' => $fileName['size'],//filesize($fileName[]),
		        'name' => $fileName['name']
		    )
		);
	}

	function download_file($diskClient, $path)
	{
		//$path = 'Новая папка/file.txt';
		$destination = 'downloads/';
		$name = 'downloaded_file.txt';
		if ($diskClient->downloadFile($path, $destination, $name))
		{
		    echo 'Файл "' . $path . '" скачен в ' . $destination . $name;
		}
	}

	function delete_file($diskClient, $target)
	{
		$target = '/Новая папка/image.png';

		if ($diskClient->delete($target))
		{
		    echo 'Файл "' . $target . '" был удален';
		}
	}
}