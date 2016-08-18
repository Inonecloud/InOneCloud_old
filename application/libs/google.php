<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 28.07.2016
 * Time: 21:03
 */
class Google implements cloudapi{

    public static function connect($client_id, $client_secret)
    {
        // TODO: Implement connect() method.
        $client_id = "135842521742-l0793cjhtc3k2sh5gng2q34r3i8iv13h.apps.googleusercontent.com";
        $client_secret = "g6UZFhKVCZXz2Y7gZTVreRD5";
        return "ya29.Ci8wA5Pt4PWMqcXBYEOYa3GzeejOzNdM94J89cAEHB2HBgv_iECExq4wF9Myze9LpA";
    }

    public function show_content($token)
    {
        // TODO: Implement show_content() method.
    }

    public function create_dir($token, $path)
    {
        // TODO: Implement create_dir() method.
    }

    public function upload_file($token, $path)
    {
        // TODO: Implement upload_file() method.
    }

    public function download_file($token, $path)
    {
        // TODO: Implement download_file() method.
    }

    public function delete_file_dir($token, $path)
    {
        // TODO: Implement delete_file_dir() method.
    }

    public function get_space_info($token)
    {
        // TODO: Implement get_space_info() method.
    }
}