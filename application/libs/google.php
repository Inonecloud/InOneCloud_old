<?php

/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 28.07.2016
 * Time: 21:03
 */
class Google implements cloudapi
{

    public static function connect($client_id, $client_secret)
    {
        // TODO: Implement connect() method.

        //redirect uri = http://inonecloud.me/dashboard/action_name


        // Не работает нефига
         $client_id = "135842521742-l0793cjhtc3k2sh5gng2q34r3i8iv13h.apps.googleusercontent.com";
        $client_secret = "g6UZFhKVCZXz2Y7gZTVreRD5";
        $scope = "&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.appdata+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.file+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.metadata+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.scripts";
        $redirect_uri = "&redirect_uri=http://inonecloud.me/dashboard/yandex_connect";
        $response_type = "&response_type=code";

        if (!isset($_GET["code"])) {
            Header("Location: https://accounts.google.com/o/oauth2/v2/auth?client_id=" . $client_id . $scope . $response_type . $redirect_uri);
            die();
        }
        $url = "https://accounts.google.com/o/oauth2/v2/auth?client_id=".$client_id.$scope.$response_type.$redirect_uri;

        //code to token exchange uri

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

        $result = postKeys("https://www.googleapis.com/oauth2/v4/token",
            array(
                'grant_type'=> 'authorization_code', // тип авторизации
                'code'=> $_GET["code"], // наш полученный код
                'client_id'=>$client_id,
                'client_secret'=>$client_secret,
                'redirect_uri'=>'http://inonecloud.me/dashboard/yandex_connect'
            ),
            array('Content-type: application/x-www-form-urlencoded')
        );

        //if ($result["code"]==200)
       // {
            $result["response"]=json_decode($result["response"],true);
            $token=$result["response"]["access_token"];
            //echo "Your token" .$token ."<br/>";
            return $token;
       // }
       // else
        //{
            //echo "Какая-то фигня! Код: ".$result["code"];
           // return $result["code"];
       // }
    }

    public function get_authorization_code(){
        $client_id = "135842521742-l0793cjhtc3k2sh5gng2q34r3i8iv13h.apps.googleusercontent.com";
        $client_secret = "g6UZFhKVCZXz2Y7gZTVreRD5";
        $scope = "https://www.googleapis.com/auth/drive"." https://www.googleapis.com/auth/drive.appdata"." https://www.googleapis.com/auth/drive.file"." https://www.googleapis.com/auth/drive.metadata"." https://www.googleapis.com/auth/drive.scripts";
        $redirect_uri = "http://inonecloud.me/dashboard/yandex_connect";
        $response_type = "code";
        $params = array(
            'response_type' => 'code',
            'client_id' => $client_id,
            'scope' => $scope,
            'redirect_uri' => $redirect_uri,
           // 'access_type' =>'offline',

        );
        $url = 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($params);
        $_SESSION['state'] = $params['state'];
        header("Location: $url");
        exit;
    }

    public function get_access_tocken(){
        $params = array(
            'code' => $_GET['code'],
            'client_id' => '135842521742-l0793cjhtc3k2sh5gng2q34r3i8iv13h.apps.googleusercontent.com',
            'client_secret' => 'g6UZFhKVCZXz2Y7gZTVreRD5',
            'redirect_uri' =>'http://inonecloud.me/dashboard/yandex_connect',
            'grant_type' => 'authorization_code',
        );

        $url = "https://www.googleapis.com/oauth2/v4/token". http_build_query($params);

        $context = stream_context_create(
            array('http' =>
                array('method' => 'POST',
                )
            )
        );

        $response = file_get_contents($url, false, $context);
	// Декодирование в "родной" объект PHP
	    $token = json_decode($response);

	    print_r($token);
        $_SESSION['access_token'] = $token->access_token; // Защитить!
        $_SESSION['expires_in'] = $token->expires_in; // относительное время
        // (в секундах)
        $_SESSION['expires_at'] = time() + $_SESSION['expires_in']; // абсолютное
        return true;
    }

    public function show_content($token)
    {
        // TODO: Implement show_content() method.

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $query = array(
            "corpus" => "user",
            "pageSize" => 100,
            "spaces" => "drive",
            "access_token" => $token
        );

        $uri = "https://www.googleapis.com/drive/v3/files" . "?" . http_build_query($query);

        curl_setopt($curl, CURLOPT_URL, $uri);
        $result = curl_exec($curl);
        echo $result;
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
        $uri = "https://www.googleapis.com/drive/v3/files/fileId";
    }

    public function delete_file_dir($token, $path)
    {
        // TODO: Implement delete_file_dir() method.
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $query = array(
            "access_token" => $token
        );
        curl_setopt($curl, CURLOPT_URL,
            "https://www.googleapis.com/drive/v3/files/" . "?" . http_build_query($query)
        );
        $result = curl_exec($curl);
        echo $result;

    }

    public function get_space_info($token)
    {
        // TODO: Implement get_space_info() method.
    }
}