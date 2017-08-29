<?php
/**
 * Created by PhpStorm.
 * User: kuro
 * Date: 29.08.17
 * Time: 6:24
 */

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
session_start();
unset($_SESSION['login']);
unset($_SESSION['pass']);
unset($_SESSION['name']);
session_destroy();
session_unset();
session_register_shutdown();
header("Location: http://$host$uri/index.php");