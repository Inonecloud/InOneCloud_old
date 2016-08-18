<?php

/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 09.03.2016
 * Time: 13:47
 */
//include('cloudapi.php');

class Dropbox implements cloudapi{

    public static function connect($client_id, $client_secret)
    {
        // TODO: Implement connect() method.
        $token = "Q1k4cCEvitwAAAAAAAAH2IFMjFpk0b5gtN9RcJMyk9xeB00apxwmGQGSyqvitto0";
        return $token;
    }

    /**
     * Show list of all files in folders in Dropbox. Use POST method
     *
     * @access public
     * @error need to check
     *
     * @param $token
     * @return mixed
     */
    public function show_content($token)
    {
        // TODO: Check show_content() method.
        $headers = array("Authorization: Bearer $token", "Content-Type: application/json; charset=utf-8");
        $param = "{\"path\": \"\",\"recursive\": false,\"include_media_info\": false,\"include_deleted\": false,\"include_has_explicit_shared_members\": false}";

        $url = 'https://api.dropboxapi.com/2/files/list_folder';
        $curl_res = $this->curl_post($url, $headers, $param);
        $info = $curl_res['info'];
        $response = $curl_res['response'];
        $code = $curl_res['code'];
        //echo '<pre>';
        //print_r($info);
        echo '<pre>';
        $result = json_decode($response, true);
        print_r($response);
        print_r($result);

        return $result;
    }

    /**
     * Create new folder in dropbox. Use POST method
     *
     * @access public
     *
     * @param $token
     * @param $path
     * @return mixed
     */
    public function create_dir($token, $path)
    {
        // TODO: Solve a problem with path.

        //Debug path
        $path = "/folder2";
        //

        $headers = array("Authorization: Bearer $token", "Content-Type: application/json; charset=utf-8");
        $param = "{\"path\": \"$path\"}";
        $url = 'https://api.dropboxapi.com/2/files/create_folder';
        $curl_res = $this->curl_post($url, $headers, $param);
        $info = $curl_res['info'];
        $response = $curl_res['response'];
        $code = $curl_res['code'];
        //echo '<pre>';
        //print_r($info);
        echo '<pre>';
        $result = json_decode($response, true);
        print_r($response);
        print_r($result);

        return $result;
    }

    public function upload_file($token, $path)
    {
        // TODO: Implement upload_file() method.
    }

    public function download_file($token, $path)
    {
        // TODO: Implement download_file() method.
    }

    /**
     * Delete folder or file from dropbox. Use POST method
     *
     * @access public
     *
     * @param $token
     * @param $path
     * @return mixed
     */
    public function delete_file_dir($token, $path)
    {
        // TODO: Solve problem with path.

        $headers = array("Authorization: Bearer $token", "Content-Type: application/json; charset=utf-8");
        $param = "{\"path\": \"$path\"}";
        $url = 'https://api.dropboxapi.com/2/files/delete';

        $curl_res = $this->curl_post($url, $headers, $param);

        $info = $curl_res['info'];
        $response = $curl_res['response'];
        $code = $curl_res['code'];
        //echo '<pre>';
        //print_r($info);
        echo '<pre>';
        $result = json_decode($response, true);
        print_r($response);
        print_r($result);

        return $result;
    }

    /**
     * Get space info about dropbox
     *
     * @access public
     *
     * @param $token
     * @return mixed
     */
    public function get_space_info($token)
    {
        // TODO: Implement get_space_info() method.
        $headers = array("Authorization: Bearer $token", "Content-Type: application/json; charset=utf-8");
        $url = 'https://api.dropboxapi.com/2/users/get_space_usage';
        $curl_res = $this->curl_post($url, $headers, "null");
        $info = $curl_res['info'];
        $response = $curl_res['response'];
        $code = $curl_res['code'];
        echo '<pre>';
        $result = json_decode($response, true);
        print_r($response);
        print_r($result);
        return $result;
    }

    /**
     * Settings for cURL POST
     *
     * @access private
     *
     * @param $url
     * @param $headers
     * @return array
     */
    private function curl_post($url, $headers, $param){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl , CURLOPT_POSTFIELDS, $param);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $response = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $info = curl_getinfo($curl);
        curl_close($curl);
        return array("response" => $response, "code" => $code, "info" => $info);
    }

    /**
     * Settings for cURL GET
     *
     * @access private
     *
     * @param $url
     * @param $headers
     * @return array
     */
    private function curl_get($url, $headers){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $response = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $info = curl_getinfo($curl);
        curl_close($curl);
        return array("response" => $response, "code" => $code, "info" => $info);
    }
}