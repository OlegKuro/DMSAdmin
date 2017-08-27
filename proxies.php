<?php
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

<?php
/**
 * Created by PhpStorm.
 * User: kuro
 * Date: 27.08.17
 * Time: 0:14
 */

require "header.php";
require "sideNav.php";
?>
<style>
    .terminatorName {
        font-size: 16px;
        text-align: center;
        letter-spacing: 2px;
        font-style: italic;
    }
</style>
<div id="main">
    <div class="container">
        <div class="row">
            <h2 style="display: block;
width: 100%; text-align: center"><span id="username" style="letter-spacing: 2px;
font-style: italic;"><?php
                    if ($_GET['player'] != '') echo $_GET['player'];
                    else echo $_SESSION['name'];
                    ?></span></h2>
            <br>
            <h3 style="text-align: center; width: 100%"><span class="usergroup" id="curUserGr" style="    letter-spacing: 1px;
    font-size: 24px;
    font-weight: lighter;
    font-style: italic;
    position: relative;
    width: 100%;
    text-align: center;
    top: -9px;
"> <?php echo $_SESSION['group']; ?></span></h3>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <canvas id="globalonl" width="800" height="550" onload="draw()"></canvas>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <canvas id="pinggraph" width="800" height="550" onload="draw()"></canvas>
            </div>
        </div>
        <hr>
        <div class="row" id="barsBlock">

        </div>
    </div>


    <script>
        $(document).ready(function () {
            drawChartPing();
            drawChartGlobal();
            barsDraw();
            setInterval(function () {
                drawChartGlobal();
                drawChartPing();
            }, 20000);
            setInterval(function () {
                barsDraw();
            }, 1000);
        });

        function drawChartGlobal() {
            var labelsarr = [];
            var onlines = [];
            (function () {
                $.get('server.php?func=globalOnlineGraphics', function (data) {
                    var dots = $.parseJSON(data);
                    dots = dots['online_info'];
                    for (var dotNum in dots) {
                        if ((dotNum == dots.length - 1) || (dotNum % 6 == 0)) {
                            labelsarr.push(parseTime(dots[dotNum]['timestamp']));
                            onlines.push(dots[dotNum]['online']);
                        }
                    }
                }).done(function () {
                    new Chart(document.getElementById("globalonl"), {
                        type: 'line',
                        data: {
                            labels: labelsarr,
                            datasets: [
                                {
                                    data: onlines,
                                    label: "Global Online",
                                    borderColor: <?php echo '"#' . rand(0, 9) . "c" . rand(0, 9) . "a" . rand(0, 9) . 'f"'?>,
                                    fill: false
                                }
                            ]
                        },
                        options: {
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        }
                    });
                });
            })();
        }

        function drawChartPing() {
            var labelsarr = [];
            var onlines = [];
            (function () {
                $.get('server.php?func=globalPing', function (data) {
                    var dots = $.parseJSON(data);
                    dots = dots['ping_info'];
                    for (var dotNum in dots) {
                        if ((dotNum == dots.length - 1) || (dotNum % 6 == 0)) {
                            labelsarr.push(parseTime(dots[dotNum]['timestamp']));
                            onlines.push(dots[dotNum]['ping']);
                        }
                    }
                }).done(function () {
                    new Chart(document.getElementById("pinggraph"), {
                        type: 'line',
                        data: {
                            labels: labelsarr,
                            datasets: [
                                {
                                    data: onlines,
                                    label: "Ping",
                                    borderColor: <?php echo '"#' . rand(0, 9) . "c" . rand(0, 9) . "a" . rand(0, 9) . 'f"'?>,
                                    fill: false
                                }
                            ]
                        },
                        options: {
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        }
                    });
                });
            })();
        }

        function barsDraw() {
            var block = document.getElementById('barsBlock');
            (function () {
                var percentage = [];
                var names = [];
                $.get('server.php?func=terminatorSucks', function (data) {
                    var machines = $.parseJSON(data);
                    machines = machines['machines'];
                    for (var cur in machines) {
                        percentage.push(
                            ((machines[cur]['load'] / machines[cur]['max_possible_load']).toFixed(4) * 100).toFixed(2)
                        );
                        var name = String(machines[cur]['name']);
                        names.push(name);
                    }
                }).done(function () {
                    block.innerHTML = '';
                    for (var i = 0; i < percentage.length; i++) {
                        var str = '';
                        str += ('<div class="col-md-3 col-lg-3 col-sm-6 col-xs-12 terminatorName">');
                        str += (names[i].replace('.dms.yt', '').replace('.network', '') + '</div>');
                        str += ('<div class="col-md-8 col-lg-8 col-sm-5 col-xs-12 col-md-offset-1 col-lg-offset-1 col-sm-offset-1">');
                        str += ('<div class="progress" style="width:100%">');
                        str += ('<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" ');
                        if (percentage[i] < 8) {
                            str += ('style="width:' + percentage[i] + '%; color:black;">' + percentage[i] + '%</div></div></div>');
                        } else {
                            str += ('style="width:' + percentage[i] + '%">' + percentage[i] + '%</div></div></div>');
                        }
                        $(block).append(str);
                    }
                });
            })();

        }


        function parseTime(timestamp) {

            //timestamp+=10800000;
            var date = new Date(timestamp);

            var hours = date.getHours();
// Minutes part from the timestamp
            var minutes = "0" + date.getMinutes();

            var month = date.getMonth() + 1;
            if (month < 10) {
                month = '0' + month;
            }

            var day = date.getDate();
            if (day < 10) {
                day = '0' + day;
            }

// Will display time in 10:30:23 format
            var formattedTime = hours + ':' + minutes.substr(-2);
            return formattedTime;
        }
    </script>
    <?php
    require "footer.php";
    ?>
