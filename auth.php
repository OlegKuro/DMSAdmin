<?php
/**
 * Created by PhpStorm.
 * User: kuro
 * Date: 21.08.17
 * Time: 0:10
 */


if (isset($_POST['login']) && isset($_POST['pass'])) {

    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    switch (getAuthType()) {
        case -1:
            header("Location: http://$host$uri?resp=-2");
            exit();
            break;
        case 1:
            header("Location: http://$host$uri/owner.php");
            exit();
            break;
        case 2:
            header("Location: http://$host$uri/admin.php");
            exit();
            break;
    }
} else {
    header("Location: http://$host$uri?resp=-1");
}

function getAuthType()
{
    $ret = rand(-1,2);
    while ($ret == 0) {
        $ret = rand(-1,2);
    }
    return $ret;
}