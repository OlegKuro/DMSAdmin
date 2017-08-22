<?php
/**
 * Created by PhpStorm.
 * User: kuro
 * Date: 21.08.17
 * Time: 23:50
 */
require_once "utilsession.php";
$temp = new utilsession();
$url = $temp->api_req . "project.getOnline?token=" . $temp->token;
$json = file_get_contents($url);
$json = json_decode($json, true);

foreach ($json as $var => $key) {
    if ($var == 'total_online') {
        $total_online = $key;
        echo $total_online . "\n";
    }
    if ($var == 'clusters') {
        foreach ($key as $cluster) {
            echo $cluster['name'] . $cluster['online'];
        }
    }
}

unset($temp);