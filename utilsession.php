<?php

/**
 * Created by PhpStorm.
 * User: kuro
 * Date: 21.08.17
 * Time: 4:56
 */
class utilsession
{
    public $token = "popochka-v-shokolade";
    public $login, $pass;
    public $api_req = "https://api.dms.yt/methods/";
    public function getToken()
    {
        return $this->token;
    }

    public $name = "Anonymous";

}