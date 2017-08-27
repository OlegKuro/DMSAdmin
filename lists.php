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


<div id="main">
    <div class="container">
        <div class="row">

        </div>
    </div>


    <?php
    require "footer.php"
    ?>
