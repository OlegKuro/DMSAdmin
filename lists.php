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
 * Time: 0:13
 */
require "header.php";
require "sideNav.php";
?>
<style>
    .list > ul {
        list-style: none;
    }
</style>

<div id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12 list" id="divBans">
                <ul id="bans">

                </ul>
            </div>
            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12 list" id="divMutes">
                <ul id="mutes">

                </ul>
            </div>
        </div>
    </div>


    <?php
    require "footer.php"
    ?>
