<?php
class GoogleLib{
	function __construct()
	{

	}

	function upload_file($fileTitle)
	{
		$file = new Google_Service_Drive_DriveFile();
		$file->setTitle('My document');
		$file->setDescription('A test document');
		$file->setMimeType('text/plain');

		$data = file_get_contents('document.txt');

		$createdFile = $service->files->insert($file, array(
      					'data' => $data,
     					'mimeType' => 'text/plain',
    					));

		print_r($createdFile);
	}
}
?>