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
 * Date: 20.08.17
 * Time: 23:39
 */
require "header.php";
?>
<link rel="stylesheet" type="text/css" href="css/default.css"/>
<link rel="stylesheet" type="text/css" href="css/component.css"/>
<script src="js/modernizr.custom.js"></script>
<div class="container-fluid">


    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <h2 style="    margin: 15px auto;
    padding-top: 20px;
    padding-bottom: -32px;
    height: 40px;
    text-transform: uppercase;
    color: gray;
    letter-spacing: 8px;
    text-align:center;">Clusters info</h2>
                </div>
            </div>
            <ul class="grid effect-4" id="grid">
                <?php
                require_once "utilsession.php";
                $temp = new utilsession();
                $url = $temp->api_req . "project.getOnline?token=" . $temp->token;
                $json = file_get_contents($url);
                $json = json_decode($json, true);

                foreach ($json as $var => $key) {
                    if ($var == 'total_online') {
                        $total_online = $key;
                        echo '<div class="row"><span id="mas-label" class="glob_online">Online : ' .
                            $total_online . '</div>';
                    }
                    if ($var == 'clusters') {
                        foreach ($key as $cluster) {
                            echo '<li><a href="#"><div class="masonry_graph" style="min-height:' . rand(100, 150) . 'px;' .
                                'background-color:rgb(' . rand(190, 210) . "," . rand(190, 210) . "," . rand(190, 210) . ');"' . '>';

                            //div inner
                            echo '<div class="row">';
                            echo '<span id="mas-label"><strong>' . $cluster['name'] . '</strong></span>';
                            echo '</div>';

                            echo '<div class="lpdied">';
                            echo '<span class="left-panel-span lpl">Online:</span>';

                            echo '<span class="left-panel-span lpr">' . $cluster["online"] . '</span>';
                            echo '</div>';
                            echo '</div></a></li>';
                        }
                    }
                }

                unset($temp);

                ?>


            </ul>
        </div>
    </div>
</div>
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
<?php
require "footer.php";
?>
