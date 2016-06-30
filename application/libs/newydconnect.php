<?php

/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 09.03.2016
 * Time: 14:12
 */
class NewYDconnect
{
    function getAuthorisationCode()
    {
        $params = array('response_type' => 'code',
                        'client_id' => 'd0387d6c503246909145797d469d7248',
                        'state' => '',

        );

        $url = 'https://oauth.yandex.ru/authorize?' . http_build_query($params);

        $_SESSION['ydstate'] = $params['state'];
        header("Location: $url");
        exit;
    }
}