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
	letter-spacing: 1px;" align="center" id="servName">' . $_GET['cluster'] . '</span>';
    echo "<br>";
    ?>
</div>


<?php

require_once "utilsession.php";
$temp = new utilsession();
$cluster = $_GET['cluster'];
function parseTime($time)
{
    $time = intdiv($time, 1000);
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
if (isset($cluster)) {
    if ($cluster != "") {
        if ($cluster == 'world') {
            $url = $temp->api_req . "project.getOnlineForGraphics?token=" . $temp->token;
            $json = file_get_contents($url);
            $json = json_decode($json, true);
            $json = $json['online_info'];
            foreach ($json as $dot) {
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
                    if (($counter + 1) % 12 == 0) {
                        array_push($labels, substr(parseTime($time), 11, 5));
                        array_push($dots, $online);
                    }
                }
            }
        } else {
            $url = $temp->api_req . "project.getOnlineForGraphics?token=" . $temp->token . "&server=" . $cluster;
            $json = file_get_contents($url);
            $json = json_decode($json, true);
            if (isset($json['error']) && !empty($json['error'])) {
                echo '<span style="
	text-transform: uppercase;
	font-weight: lighter;
	display: block;
	text-align: center;
	font-size: 15px;
	color: #000;
	letter-spacing: 1px;">' . '!server is unavailable!' . '</span>';
            } else {
                $json = $json['online_info'];
                foreach ($json as $dot) {
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
                        if (($counter + 1) % 12 == 0) {
                            array_push($labels, substr(parseTime($time), 11, 5));
                            array_push($dots, $online);
                        }
                    }
                }
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
                    {
                        data: <?php echo json_encode($dots)?>,
                        label: "Online",
                        borderColor: "#3e95cd",
                        fill: false
                    }
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