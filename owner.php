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
require "sideNav.php"
?>
<div id="main">

    <div class="container" id="main-cont">
        <div class="row">
            <h2 style="display: block;
width: 100%; text-align: center"><span id="username" style="letter-spacing: 2px;
font-style: italic;"><?php
                    if ($_GET['player'] != '') echo $_GET['player'];
                    else echo $_SESSION['name'];
                    ?></span></h2>
            <br>
            <h3 style="text-align: center; width: 100%"><span class="usergroup" style="    letter-spacing: 1px;
    font-size: 24px;
    font-weight: lighter;
    font-style: italic;
    position: relative;
    width: 100%;
    text-align: center;
    top: -9px;
">Kostik :3</span></h3>
        </div>
        <div class="row">
            <button type="button" class="btn btn-default" onclick="updForc(this)" style="margin: 0 auto;">Обновить
                информацию о пользователе
            </button>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12" style="min-width:392px !important;">

            <div class="row">
                <span style="    letter-spacing: 1px;
    font-size: 18px;
    text-transform: uppercase;
    text-align: center;
    font-style: italic;
    position: relative;
    width: 100%;
">друзья</span>
            </div>
            <div class="row">
                <table class="table table-bordered table-sm table-hover table-striped" id="friendsTable">
                    <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Сервер</th>
                        <th>Онлайн</th>
                    </tr>
                    </thead>
                    <tbody id="friendList">

                    </tbody>
                </table>

            </div>
        </div>

    </div>


    <textarea name="kek" id="req" cols="30" rows="1"></textarea>
    <button type="button" onclick="clicked()"></button>

</div>

<script type="text/javascript">
    function clicked() {
        var player = $('textarea#req').val();
        $.get('./server.php?func=getStats&player=' + player, function (data) {
            alert("Data loaded:" + data);
        });
    }
    $(document).ready(function () {
        var player = document.getElementById("username").innerHTML;
        $.get('./server.php?func=getFriends&player=' + player, function (data) {
            var table = $("#friendsTable");
            var jsonObj = $.parseJSON(data);

            for (var curFriend in jsonObj.friends) {
                table.append('<tr onclick="toFriend(this)" class="frrow">' +
                    '<th scope="row" id="curnamefr">' + jsonObj.friends[curFriend].name + '</th>' +
                    '<td>' + jsonObj.friends[curFriend].server + '</td>' +
                    '<td>' + ((jsonObj.friends[curFriend].online == true) ? 'Сейчас' : parseTime(jsonObj.friends[curFriend].last_exit_time)) + '</td>'
                    + '</tr>'
                );
            }
        })
    });

    function updForc(el) {
        var player = document.getElementById("username").innerHTML;
        $.get('./server.php?func=updateMyHuy&player=' + player, function (data) {
            var table = $("#friendsTable");
            var jsonObj = $.parseJSON(data);
            if (jsonObj.updated == true || jsonObj.updated == "true") {
                $(el).addClass("btn-success");
                setTimeout(function () {
                    location.reload();
                }, 3000);
            } else {
                $(el).addClass("btn-danger");
                setTimeout(function () {
                    location.reload();
                }, 1500);
            }
        })
    }
    function toFriend(rw) {
        var k = $(rw).find("#curnamefr").html();
        window.location.href = "owner.php?player=" + k;
    }
    function parseTime(timestamp) {

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
        var formattedTime = day + '.' + month + ' ' + hours + ':' + minutes.substr(-2);
        return formattedTime;
    }
</script>
<?php
require "footer.php";
?>
