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

	function show_name($diskClient)
	{
		return $login = $diskClient->getLogin();
	}

	function show_dir($diskClient)
	{
		$dirContent = $diskClient->directoryContents('/');

		foreach ($dirContent as $dirItem) {
		    if ($dirItem['resourceType'] === 'dir') {
		        echo 'Directory "' . $dirItem['displayName'] . date(
		                'Y-m-d в H:i:s',
		                strtotime($dirItem['creationDate'])
		            ) . '<br />';
		    } else {
		        echo 'File "' . $dirItem['displayName'] . '" Size ' . $dirItem['contentLength'] . ' bites ' . date(
		                'Y-m-d в H:i:s',
		                strtotime($dirItem['creationDate'])
		            ) . '<br />';
		    }
		}
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
		$fileName = 'My_video_1.avi';
		$newName = 'My_cool_video_1.avi';

		$diskClient->uploadFile(
		    '/Новая папка/',
		    array(
		        'path' => $fileName,
		        'size' => filesize($fileName),
		        'name' => $newName
		    )
		);
	}

	function download_file($diskClient, $path, $destination, $name)
	{
		$path = 'Новая папка/file.txt';
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