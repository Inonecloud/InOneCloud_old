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
        $client_id = "135842521742-l0793cjhtc3k2sh5gng2q34r3i8iv13h.apps.googleusercontent.com";
        $client_secret = "g6UZFhKVCZXz2Y7gZTVreRD5";
        $scope = "&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.appdata+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.file+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.metadata+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.scripts";
        $redirect_uri = "&redirect_uri=http://inonecloud.me/dashboard";
        $response_type = "&response_type=code";

        if (!isset($_GET["code"])) {
            Header("Location: https://accounts.google.com/o/oauth2/v2/auth?client_id=" . $client_id . $scope . $response_type . $redirect_uri);
            die();
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
        return "ya29.Ci-CAyaYtQ-2c9ANxagLnNbN1hQhu7h7-36tsaQBuGMElVaG7Ys-vxo4zW1AtKiWwA";
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
            "access_token" => "ya29.CjCFA3VQFzBccNASDCkecX9Fia1AwWT6YLueqjWApKo1TQu0hwSk56oSxUveKLeQsC4"
        );
        $url = "https://www.googleapis.com/drive/v3/files" . "?" . http_build_query($query);
        curl_setopt($curl, CURLOPT_URL, $url);
        $result = curl_exec($curl);
        return result;
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