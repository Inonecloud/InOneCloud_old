<?php

/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 27.06.2016
 * Time: 16:13
 */
include('cloudapi.php');

class Yandex implements cloudapi
{

    /**
     * Connecting with yandex disk
     *
     * @param string $client_id
     * @param string $client_secret
     * @return mixed
     */
    public static function connect($client_id, $client_secret)
    {
        {
            if (!isset($_GET["code"]))
            {
                Header("Location: https://oauth.yandex.ru/authorize?response_type=code&client_id=".$client_id);
                die();
            }

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

    /**
     * Show all files and folders from Yandex disk
     *
     * @access public
     *
     * @param string $token
     * @return mixed
     */
    public function show_content($token)
    {
        $headers = array("Authorization: OAuth $token", "Content-Type: application/hal+json; charset=utf-8");
        $url = 'https://cloud-api.yandex.net:443/v1/disk/resources?path=%2F&limit=100';

        $curl_res = $this->curl_get($url, $headers);
        $info = $curl_res['info'];
        $response = $curl_res['response'];
        $code = $curl_res['code'];

        print_r($info);
        if ($info['http_code'] != '200') {
            //echo 'Error ' . $info['http_code'];
            return  $info['http_code'];
        } else {
            //echo 'OK';
            echo "<pre>";
            $result = json_decode($response, true);
            //$json = json_decode($response);
            print_r($result);
            return $result;
        }
    }

    /**
     * Create a new folder in Yandex disk
     *
     * @access public
     *
     * @param string $token
     * @param string $path
     * @return mixed
     */
    public function create_dir($token, $path)
    {
        $headers = array("Authorization: OAuth $token", "Content-Type: application/hal+json; charset=utf-8");
        $url = 'https://cloud-api.yandex.net:443/v1/disk/resources?path=%2F'.$path;
        $curl_res = $this->curl_put($url, $headers);
        $info = $curl_res['info'];
        $response = $curl_res['response'];
        $code = $curl_res['code'];
        print_r($info);
        if ($info['http_code'] != '201') {
            echo 'Error ' . $info['http_code'];
            return  $info['http_code'];
        } else {
            $result = json_decode($response, true);
            return $result;
        }
    }

    /**
     * Upload file to Yandex Disk
     *
     * @access public
     * @error uploaded null bytes file
     *
     * @param $token
     * @param $path
     * @return mixed
     */
    public function upload_file($token, $path)
    {
        // TODO: Implement upload_file() method.
        // TODO: Write part for loader via response
        $headers = array("Authorization: OAuth $token", "Content-Type: application/hal+json; charset=utf-8");
        $url = 'https://cloud-api.yandex.net:443/v1/disk/resources/upload?path=%2F'.$path['name'];

        $curl_res = $this->curl_get($url, $headers);
        $info = $curl_res['info'];
        $response = $curl_res['response'];
        $code = $curl_res['code'];

        print_r($info);
        if ($info['http_code'] != '200') {
            //echo 'Error ' . $info['http_code'];
            return  $info['http_code'];
        } else {
            //echo 'OK';
            echo "<pre>";
            $result = json_decode($response, true);
            $url = $result['href'];
            $curl_res = $this->curl_put($url, $headers);
            //print_r($result);
            $info = $curl_res['info'];
            $response = $curl_res['response'];
            $code = $curl_res['code'];
            print_r($info);
            if ($info['http_code'] != '201') {
                echo 'Error ' . $info['http_code'];
                return  $info['http_code'];
            } else {
                $result = json_decode($response, true);
                return $result;
            }
        }
    }

    /**
     * Download file from Yandex Disk
     *
     * @access public
     *
     * @param $token
     * @param $path
     * @return mixed
     */
    public function download_file($token, $path)
    {
        // TODO: Implement download_file() method.
        $headers = array("Authorization: OAuth $token", "Content-Type: application/hal+json; charset=utf-8");
        $url = 'https://cloud-api.yandex.net:443/v1/disk/resources/download?path=%2F'.$path;

        $curl_res = $this->curl_get($url, $headers);
        $info = $curl_res['info'];
        $response = $curl_res['response'];
        $code = $curl_res['code'];

        print_r($info);
        if ($info['http_code'] != '200') {
            return  $info['http_code'];
        } else {
            $result = json_decode($response, true);
            $url = $result['href'];
            header('location: '.$url);
        }
    }


    public function delete_file_dir()
    {
        // TODO: Implement delete_file() method.
    }


    /**
     * Get Yandex disk meta data
     *
     * @access public
     *
     * @param string $token
     * @return mixed
     */
    public function get_space_info($token){
        //TODO: Write RESTful code to take space information
        $headers = array("Authorization: OAuth $token", "Content-Type: application/hal+json; charset=utf-8");
        $url = 'https://cloud-api.yandex.net:443/v1/disk';
        $curl_res = $this->curl_get($url, $headers);
        $info = $curl_res['info'];
        $response = $curl_res['response'];
        $code = $curl_res['code'];
        print_r($info);
        if ($info['http_code'] != '200') {
            //echo 'Error ' . $info['http_code'];
            return  $info['http_code'];
        } else {
            //echo 'OK';
            echo "<pre>";
            $result = json_decode($response, true);
            //$json = json_decode($response);
            print_r($result);
            return $result;
        }
    }

    /**
     * Settings for cURL PUT
     *
     * @access private
     *
     * @param string $url
     * @param string array $headers
     * @return array
     */
    private function curl_put($url, $headers){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_PUT, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_HEADER, 0);
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
     * @param string $url
     * @param string array $headers
     * @return array
     */
    private function curl_get($url, $headers){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        $response = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $info = curl_getinfo($curl);
        curl_close($curl);
        return array("response" => $response, "code" => $code, "info" => $info);
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
    private function curl_post($url, $headers){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        $response = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $info = curl_getinfo($curl);
        curl_close($curl);
        return array("response" => $response, "code" => $code, "info" => $info);
    }
}