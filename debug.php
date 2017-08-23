<?php
/**
 * Created by PhpStorm.
 * User: kuro
 * Date: 22.08.17
 * Time: 18:16
 */

require_once "utilsession.php";

function parseTime($time)
{
    $time = intdiv($time, 1000);
    $time = gmdate("Y-m-d H:i:s", $time);
    return $time;
}

$temp = new utilsession();
$_GET['cluster'] = 'world';
$cluster = $_GET['cluster'];
$url = $temp->api_req . "project.getOnline?token=" . $temp->token;
$json = file_get_contents($url);
$json = json_decode($json, true);
$namesOfClusters = array();
$dots = array();
//fetching names of clusters (don't take 'another')
foreach ($json as $var => $key) {
    if ($var == 'clusters') {
        foreach ($key as $cl){
            $cur_cl = $cl['name'];
            if ($cur_cl == 'another')
                continue;
            $url = $temp->api_req . "project.getOnlineForGraphics?token=" . $temp->token . "&server=" . $cur_cl;
            $jsonka = file_get_contents($url);
            $jsonka = json_decode($jsonka, true);
            if (isset($jsonka['error']) || !empty($jsonka['error'])) {
                continue;
            }
            $dots[$cur_cl] = array();
            array_push($namesOfClusters, $cur_cl);
        }
    }
}

$for_labels = 0;
$counter = 0;
foreach ($namesOfClusters as $cur_cl){

    $url = $temp->api_req . "project.getOnlineForGraphics?token=" . $temp->token . "&server=" .$cur_cl;
    $json = file_get_contents($url);
    $json = json_decode($json, true);
    $json = $json['online_info'];
    foreach ($json as $dot) {
        $pushed = 0;
        foreach ($dot as $key => $value) {
            switch ($key) {
                case 'timestamp':
                    $time = $value;
                    break;
                case 'online':
                    $online = $value;
            }
            $counter++;
            if ($counter == 1) {
                continue;
            }
            if (($for_labels == 0) && (($counter + 1) % 12 == 0)) { //fetching labels for graph
                array_push($labels, substr(parseTime($time), 11, 5));
            }
            if (($counter + 1) % 12 == 0) {
                //smart move: 0..79 first name 80..159 second e.t.c
                $pushed++;
                array_push($dots[$cur_cl], $online);
            }
        }
    }
    $for_labels++;
}

echo count($dots) . "=" . count($namesOfClusters);
foreach ($namesOfClusters as $namesOfCluster) {
    echo "\n" . 'cluster=' . $namesOfCluster . ' dots=' . count($dots[$namesOfCluster]);
}
echo "\n";
echo json_encode($dots["@hg"]);