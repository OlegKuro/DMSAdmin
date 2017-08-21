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
switch (getAuthType()) {
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

function getAuthType()
{
    $ret = rand(-1, 2);
    while ($ret == 0) {
        $ret = rand(-1, 2);
    }
    return $ret;
}

function startSesssion($login, $pass)
{
    session_start();
    $_SESSION['login'] = $login;
    $_SESSION['pass'] = $pass;
    return;
}