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
        // Не работает нефига
        $client_id = "135842521742-l0793cjhtc3k2sh5gng2q34r3i8iv13h.apps.googleusercontent.com";
        $client_secret = "g6UZFhKVCZXz2Y7gZTVreRD5";
        $scope = "&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.appdata+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.file+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.metadata+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.scripts";
        $redirect_uri = "&redirect_uri=http://inonecloud.me/dashboard";
        $response_type = "&response_type=code";

        echo "Hello";
        echo $_GET;
        if (!isset($_GET["code"])) {
            Header("Location: https://accounts.google.com/o/oauth2/v2/auth?client_id=" . $client_id . $scope . $response_type . $redirect_uri);
      //      die();
        }
        //$url = "https://accounts.google.com/o/oauth2/v2/auth?client_id=".$client_id.$scope.$response_type.$redirect_uri;

        //Code getting uri
        //https://accounts.google.com/o/oauth2/v2/auth
        //?redirect_uri=https%3A%2F%2Fdevelopers.google.com%2Foauthplayground
        //&prompt=consent
        //&response_type=code
        //&client_id=407408718192.apps.googleusercontent.com
        //&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.appdata+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.file+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.metadata+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.scripts
        //&access_type=offline
        //https://accounts.google.com/o/oauth2/v2/auth?client_id=135842521742-l0793cjhtc3k2sh5gng2q34r3i8iv13h.apps.googleusercontent.com&response_type=code&scope=https://www.googleapis.com/auth/drive&redirect_uri=http://inonecloud.me/dashboard


        //code to token exchange uri

        //POST /oauth2/v4/token HTTP/1.1
        //Host: www.googleapis.com
        //Content-Type: application/x-www-form-urlencoded

        //https://www.googleapis.com/oauth2/v4/token?
        //code=$code;
        //&client_id=135842521742-l0793cjhtc3k2sh5gng2q34r3i8iv13h.apps.googleusercontent.com
        //&client_secret=g6UZFhKVCZXz2Y7gZTVreRD5
        //&redirect_uri=http://inonecloud.me/dashboard
        //&grant_type=authorization_code

        /*
             "access_token": "ya29.Ci-CAyaYtQ-2c9ANxagLnNbN1hQhu7h7-36tsaQBuGMElVaG7Ys-vxo4zW1AtKiWwA",
              "token_type": "Bearer",
              "expires_in": 3600,
              "refresh_token": "1/tmxSzdI_0gOL8yTKTWRHpP3FQTfTZqVZajyBr05gZCI"
         */
        //$_GET['code'] = '4/uFxju4g2Uh1iL3-WGj8hHmFCaflSCMEbfwuysUmYIBk';
        print_r($_GET);
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
                'redirect_uri'=>'http://inonecloud.me/dashboard'
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

    public function show_content($token)
    {
        // TODO: Implement show_content() method.
        // $header =  ;
        // $url = https://www.googleapis.com/drive/v3/files;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $query = array(
            "corpus" => "user",
            "pageSize" => 100,
            "spaces" => "drive",
            "access_token" => $token
        );
        $url = "https://www.googleapis.com/drive/v3/files" . "?" . http_build_query($query);
        curl_setopt($curl, CURLOPT_URL, $url);
        $result = curl_exec($curl);
        echo "GOOGLE";
        echo $token;
        print_r($result);
       // return $result;
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
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //$query = array(
         //   "access_token" => "ya29.CjCFA3VQFzBccNASDCkecX9Fia1AwWT6YLueqjWApKo1TQu0hwSk56oSxUveKLeQsC4"
        //);
        $url = "https://www.googleapis.com/drive/v3/files/?" . $token;
        curl_setopt($curl, CURLOPT_URL, $url);
        $result = curl_exec($curl);
        echo $result;
    }

    public function get_space_info($token)
    {
        // TODO: Implement get_space_info() method.
    }
}