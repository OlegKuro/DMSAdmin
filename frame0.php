<?php
/**
 * Created by PhpStorm.
 * User: kuro
 * Date: 22.08.17
 * Time: 18:16
 */
session_start();
if ($_SESSION['login'] == "" || $_SESSION['pass'] == "") {
    header("Location: /?resp=-3");
    exit();
}
if (!isset($_SESSION['login']) || !isset($_SESSION['pass'])) {
    header("Location: /?resp=-3");
    exit();
}

require 'header.php';
?>

<link rel="stylesheet" type="text/css" href="css/default.css">
<link rel="stylesheet" type="text/css" href="css/component.css">
<style>
    .grid>li {
        width: 18% !important;
        min-width: 143px;
    }

    .bottompan {
        vertical-align: bottom;
        position: absolute;
        display: inline;
        bottom: 12px;
        left: 0;
    }
</style>
<script src="js/modernizr.custom.js"></script>
    <div class="container">
        <?php
        echo '<span style="
	text-transform: uppercase;
	font-weight: lighter;
	font-size: 12px;
	color: #000;
	letter-spacing: 1px;
	display:block;
	text-align:center;
	position: relative;
top: 28px;" align="center" id="servName">' . $_GET['server'] . '</span>';
        echo "<br>";
        ?>
    </div>


<ul class="grid effect-4" id="grid">
<?php

$data = array();
require_once "utilsession.php";
$temp = new utilsession();
$curCluster = $_GET['server'];
if (isset($curCluster)) {
    if ($curCluster != "") {
        $url = $temp->api_req . "project.getClusterOnline?token=" . $temp->token . "&cluster=" . $curCluster;
        $json = file_get_contents($url);
        $json = json_decode($json, true);
        $json = $json['servers'];
        //data fetching
        foreach ($json as $serverok) {
            foreach ($serverok as $key => $value) {
                if ($key == 'name') {
                    $nm = $value;
                }
                if ($key = 'online') {
                    $onl = $value;
                }
            }
            $data[$nm] = $onl;
        }

        foreach ($data as $nm => $onl) {
            $url = $temp->api_req . "project.getServerInfo?token=" . $temp->token . "&server=" . $nm;
            $json = file_get_contents($url);
            $json = json_decode($json, true);
            $s = $json['machine'];
            $s = str_replace(".dms.yt", "", $s);
            $s = str_replace(".network", "", $s);
            echo '<li id="'. $nm .'"><a><div class="masonry_graph" style="min-height:' . (150 + ($onl / 3 )) . 'px;' .
                'background-color:rgb(' . rand(170, 190) . "," . rand(170, 210) . "," . rand(180, 210) . ');"' . '>';

            //div inner
            echo '<div class="row">';
            echo '<span id="mas-label"><strong>' . $nm. '</strong></span>';
            echo '</div>';

            echo '<div class="lpdied">';
            echo '<span class="left-panel-span lpl" style="
    width: 100%;
    font-size: 11px;">' . $json['address'] . ':' . $json['port'] . '</span>';
            echo '</div>';

            echo '<div class="lpdied">';
            echo '<span class="left-panel-span lpl" style="
    width: 100%;
    font-size: 14px;">' . $s . '</span>';
            echo '</div>';

            echo '<div class="lpdied bottompan">';
            echo '<span class="left-panel-span lpl" style="
    width: 100%;
    font-size: 16px;">Online: ' . $onl . '</span>';
            echo '</div>';


            echo '</div></a></li>';

        }


    } else {
        echo "This cluster has no servers... sorry";
    }
}
?>

</ul>
<script
    src="https://code.jquery.com/jquery-3.2.1.js"
    integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>

<script src="js/frame0.js"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/imagesloaded.js"></script>
<script src="js/classie.js"></script>
<script src="js/AnimOnScroll.js"></script>
<script>
    new AnimOnScroll(document.getElementById('grid'), {
        minDuration: 0.4,
        maxDuration: 0.7,
        viewportFactor: 0.2
    });
</script>