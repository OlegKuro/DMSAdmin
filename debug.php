<?php
require_once "utilsession.php";
$t = new utilsession();
$url = $t->api_req . 'project.getProxiesList?token=' . $t->token;
$json = file_get_contents($url);
$json = json_decode($json, true);
$json = $json['proxies'];
foreach ($json as $key => $value) {
    if ($value != '__global__')
        echo '<li id="' . $value . '">' . $value . '</li>';
}
