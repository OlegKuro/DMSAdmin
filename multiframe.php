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
?>

<div class="container">
    <?php
    echo '<span style="
	text-transform: uppercase;
	font-weight: lighter;
	font-size: 12px;
	color: #000;
	letter-spacing: 1px;
	display:block;
	text-align:center;" align="center" id="servName">' . 'TOP-5 Clusters' . '</span>';
    echo "<br>";
    ?>
</div>


<?php

require_once "utilsession.php";
$temp = new utilsession();
$cluster = $_GET['all'];
function parseTime($time)
{
    $time = intdiv($time, 1000) + 10800;
    $time = gmdate("Y-m-d H:i:s", $time);
    return $time;
}


function cmp($first, $second)
{
    $length = strlen($first);
    if (strlen($first) > strlen($second)) {
        return true;

    }
    if (strlen($first) < strlen($second)) {
        return false;
    }
    $first = str_split($first);
    $second = str_split($second);
    if (strlen($first) == strlen($second)) {

        for ($i = 0; $i < $length; $i++) {
            if ($first[$i] > $second[$i])
                return true;
            if ($first[$i] < $second[$i])
                return false;
            continue;
        }
        return true;
    }
}

$counter = 0;
$time = 0;
$labels = array();
$dots = array();
$namesOfClusters = array();
if (isset($cluster)) {
    if ($cluster != "") {
        if ($cluster == 'true') {
            $url = $temp->api_req . "project.getOnline?token=" . $temp->token;
            $json = file_get_contents($url);
            $json = json_decode($json, true);

            $fuckmepls = 0;
            //fetching names of clusters (don't take 'another')
            foreach ($json as $var => $key) {
                if ($var == 'clusters') {
                    foreach ($key as $cl) {
                        if ($fuckmepls == 5)
                            break;
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
                        $fuckmepls++;
                    }
                }
            }

            $for_labels = 0;
            $counter = 0;
            foreach ($namesOfClusters as $cur_cl) {

                $url = $temp->api_req . "project.getOnlineForGraphics?token=" . $temp->token . "&server=" . $cur_cl;
                $json = file_get_contents($url);
                $json = json_decode($json, true);
                $json = $json['online_info'];
                $counter = 0;
                foreach ($json as $dot) {
                    $time = 0;
                    $online = 0;
                    foreach ($dot as $key => $value) {
                        switch ($key) {
                            case 'timestamp':
                                $time = $value;
                                break;
                            case 'online':
                                $online = $value;
                                break;
                        }
                    }
                    $counter++;
                    if ($counter == 1) {
                        continue;
                    }
                    if (($for_labels == 0) && (($counter + 1) % 12 == 0 || $counter == count($json))) { //fetching labels for graph
                        array_push($labels, substr(parseTime($time), 11, 5));
                    }
                    if (($counter + 1) % 12 == 0 || $counter == count($json)) {
                        //smart move: 0..79 first name 80..159 second e.t.c
                        array_push($dots[$cur_cl], $online);
                    }

                }
                $for_labels++;
            }
        }
    }

} else {
    echo "Unknown error. Please write to administration";
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [
                    <?php
                    $counter = 0;
                    foreach ($namesOfClusters as $cl) {

                        echo '{data:' . json_encode($dots[$cl]) . ",";

                        echo 'label:';
                        echo '"' . $cl . '",';

                        echo 'borderColor: "#' . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . '",';

                        echo 'fill: false}';
                        if ($counter != count($namesOfClusters) - 1) {
                            echo ",";
                        }
                    }
                    $counter++;
                    ?>
                ]
            },
            options: {
                legend: {
                    display: true,
                    position: 'right'
                }
            }
        });
    });


</script>

<style>
    #line-chart {
        margin-top: 20px;
    }

    #servName {
        text-align: center;
        display: block;
    }
</style>
<canvas id="line-chart" width="800" height="450" onload="draw()"></canvas>
