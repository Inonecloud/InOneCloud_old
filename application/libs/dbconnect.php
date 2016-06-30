<?php

/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 09.03.2016
 * Time: 13:47
 */
define('DB_KEY', 'vaiywec6d6ofwxw');
define('DB_SECRET','nfd5tjn5nzpv7kg');
//define('DB_REDIRECT_LINK,');
class DBconnect
{
    function getAuthorisationCode()
    {
        $params = array('response_type' =>,
                        'client_id' =>,
                        'redirect_uri' =>,
                        'state' =>,
                        'require_role' =>,
                        'force_reapprove' =>,
                        'disable_signup' =>
                        );
        $url = 'https://www.dropbox.com/1/oauth2/authorize' . ;
        $_SESSION['state'] = $params['state'];
        header("Location: $url");
        exit;
    }

    function getAccessTocken()
    {
        $params = array('
                        ');
    }
}