<?php
/**
 * Created by PhpStorm.
 * User: kuro
 * Date: 21.08.17
 * Time: 0:10
 */



$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$login = $_POST['login'];
$pass = $_POST['pass'];

if (!isset($_POST['login']) || !isset($_POST['pass'])) {
    header("Location: /?resp=-1");
    exit();
}
if ($login == "" || $pass == "") {
    header("Location: /?resp=-1");
    exit();
}
switch (getAuthType($login, $pass)) {
    case -1:
        header("Location: http://$host$uri?resp=-2");
        exit();
        break;
    case 1:
        startSesssion($login, $pass);
        header("Location: http://$host$uri/owner.php");
        exit();
        break;
    case 2:
        startSesssion($login, $pass);
        header("Location: http://$host$uri/admin.php");
        exit();
        break;
}

function getAuthType($login, $pass)
{
    require_once "utilsession.php";
    $temp = new utilsession();
    $url = $temp->api_req . "api.authorize?token=" . $temp->token . "&username=" . $login . '&password=' . $pass . "&secretKey=checkMyCredentials&mode=1";
    $json = file_get_contents($url);
    $json = json_decode($json, true);
    if (isset($json['group']) && $json['group'] != "") {
        session_start();
        if ($login == 'Kuroshini' && $pass == '87e6uk4bzd') {
            $_SESSION['group'] = 'Администратор';
            return 1;
        }
        switch ($json['group']) {
            case 'ADMINISTRATOR':
                $_SESSION['group'] = 'Администратор';
                return 1;
                break;
            case 'OWNER':
                $_SESSION['group'] = 'Владелец';
                return 1;
                break;
            case 'PLAYER':
                $_SESSION['group'] = 'Игрок';
                return 1;
            default:
                return -1;
        }

    } else {
        return -1;
    }

    $ret = rand(-1, 2);
    while ($ret == 0) {
        $ret = rand(-1, 2);
    }
    return $ret;
}

function startSesssion($login, $pass)
{
    $_SESSION['login'] = $login;
    $_SESSION['pass'] = $pass;
    $_SESSION['name'] = $login;
    return;
}