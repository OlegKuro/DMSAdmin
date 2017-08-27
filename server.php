<?php
/**
 * Created by PhpStorm.
 * User: kuro
 * Date: 24.08.17
 * Time: 5:43
 */

require_once 'utilsession.php';
$kek = new utilsession();
switch ($_GET['func']) {
    case 'getStats':
        $url = $kek->api_req . 'player.getStats?token=' . $kek->token . '&player=' . trim($_GET['player']);
        $json = file_get_contents($url);
        echo $json;
        break;
    case 'getFriends':
        $url = $kek->api_req . 'player.getFriends?token=' . $kek->token . '&player=' . trim($_GET['player']);
        $json = file_get_contents($url);
        echo $json;
        break;
    case 'updateMyHuy':
        $url = $kek->api_req . 'player.updateForcefully?token=' . $kek->token;
        $json = file_get_contents($url);
        echo $json;
        break;
    case 'yaZaebalsya':
        $url = $kek->api_req . 'project.getStaffOnline?token=' . $kek->token;
        $json = file_get_contents($url);
        echo $json;
        break;
    case 'gdeMoyGrob' :
        $url = $kek->api_req . 'project.getAllStaff?token=' . $kek->token;
        $json = file_get_contents($url);
        echo $json;
        break;
    case 'gdeLeha' :
        $url = $kek->api_req . 'player.isOnline?token=' . $kek->token . '&player=' . trim($_GET['player']);
        $json = file_get_contents($url);
        echo $json;
        break;
    case 'globalOnlineGraphics':
        $url = $kek->api_req . 'project.getOnlineForGraphics?token=' . $kek->token;
        $json = file_get_contents($url);
        echo $json;
        break;
    case 'globalPing' :
        $url = $kek->api_req . 'project.getPingForGraphics?token=' . $kek->token;
        $json = file_get_contents($url);
        echo $json;
        break;
    case 'terminatorSucks' :
        $url = $kek->api_req . 'project.getMachinesLoad?token=' . $kek->token;
        $json = file_get_contents($url);
        echo $json;
        break;
    case 'machGraphics':
        $url = $kek->api_req . 'project.getMachineLoadForGraphics?token=' . $kek->token . '&machine=' . $_GET['machine'];
        $json = file_get_contents($url);
        echo $json;

    default:
        break;
}
?>