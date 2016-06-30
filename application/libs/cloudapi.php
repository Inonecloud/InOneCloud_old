<?php

/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 27.06.2016
 * Time: 16:06
 */
interface cloudapi
{
    public static function connect($client_id, $client_secret);
    public function show_content($token);
    public function create_dir($token, $path);
    public function upload_file();
    public function download_file();
    public function delete_file();
    public function delete_dir();

}