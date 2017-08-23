<?php
/**
 * Created by PhpStorm.
 * User: kuro
 * Date: 23.08.17
 * Time: 19:28
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

<?php

require_once "utilsession.php";
$temp = new utilsession();
$url = $temp->api_req . "project.getOnline?token=" . $temp->token;
$json = file_get_contents($url);
$json = json_decode($json, true);

echo '<span style="color: black; letter-spacing: 2px; font-size: 14px; text-transform: uppercase; font-family: sans-serif; font-weight: lighter;
">Online : ' . $json['total_online'] . '</span>';
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        <?php
        foreach ($json['clusters'] as $node) {
            $id = $node['name'];
            $val = $node['online'];

            echo 'window.parent.document.getElementById("' . "clus" . $id . '").innerHTML = "' . $val . '";';
        }
        ?>
    });
</script>
