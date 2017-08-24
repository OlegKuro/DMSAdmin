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
<style>
    .success {
        background: #d8ff9b !important;
    }

    .gamesInfo > div > div {
        text-align: center;
        padding-top: 20px;
    }

    .gamesInfo > div > div > ul {
        margin-top: 10px;
        margin-bottom: 1rem;
        list-style: none;
        float: unset;
        text-transform: uppercase;
        font-size: 14px;
        font-weight: 200;
        color: black;
        padding-left: 0px;
    }

    #friendsList tr {
        cursor: pointer;
    }

    .typegame {
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 3px;
        font-weight: bolder;
        font-size: 16px;
    }
</style>
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
        <div class="row" style="margin-top:15px;">
            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">

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
                    <table class="table table-sm table-hover table-condensed" id="friendsTable">
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
                <hr>
                <div class="row">
                    <div class="form-group">
                        <label for="usr">Поиск игрока:</label>
                        <input type="text" class="form-control" id="usr" placeholder="<?php echo $_GET['player'] ?>">
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-lg-8 col-sm-6 col-xs-12 gamesInfo">
                <?php
                function corr($input)
                {
                    return str_replace("_", " ", $input);
                }

                function transl($input)
                {
                    switch ($input) {
                        case 'kills':
                            return 'убийств';
                            break;
                        case 'wins':
                            return 'побед';
                            break;
                        case 'ore mined':
                            return 'руды собрано';
                            break;
                        case 'silver':
                            return 'серебро';
                            break;
                        case 'wood cutten':
                            return 'деревьев срублено';
                            break;
                        case 'melee kills':
                            return 'убийств в ближнем бою';
                            break;
                        case 'deaths':
                            return 'смертей';
                            break;
                        case 'ranged kills':
                            return 'убийств в дальнем бою';
                            break;
                        case 'points':
                            return 'очков';
                            break;
                        case 'duo kills':
                            return 'двойных убийств';
                            break;
                        case 'solo kills':
                            return 'одиночных убийств';
                            break;
                        case 'quadro kills':
                            return 'убийств четверых';
                            break;
                        case 'octo kills':
                            return 'убийств восьмерых';
                            break;
                        case 'octo wins':
                            return 'стриков из восьми побед';
                            break;
                        case 'solo wins':
                            return 'одиночных побед';
                            break;
                        case 'quadro wins':
                            return 'стриков из четырех побед';
                            break;
                        case 'duo wins':
                            return 'стриков из двух побед';
                            break;
                        case 'level':
                            return 'уровень';
                            break;
                        case 'dollars':
                            return 'долларов';
                            break;
                        case 'blocks broken':
                            return 'блоков разрушено';
                            break;
                        case 'wins as hider':
                            return 'побед за прячущегося';
                            break;
                        case 'players caught':
                            return 'игроков поймано';
                            break;
                        case 'games played':
                            return 'игр сыграно';
                            break;
                        case 'zombies killed':
                            return 'зомби убито';
                            break;
                        case 'survivors killed':
                            return 'спасающихся убито';
                            break;
                        default:
                            return $input;
                    }
                }

                require_once "utilsession.php";
                $temp = new utilsession();
                $url = $temp->api_req . "player.getStats?token=" . $temp->token . '&player=' . $_GET['player'];
                $json = file_get_contents($url);
                $json = json_decode($json, true);
                $counter = 0;
                foreach ($json as $typegame => $game) {
                    $counter++;
                    if ($counter % 2 == 1)
                        echo '<div class="row">';
                    echo '<div class="col-md-5 col-lg-5 col-sm-12 col-xs-12 col-md-offset-1 col-lg-offset-1">';

                    echo '<span class="typegame">';
                    echo corr($typegame);
                    echo '</span>';

                    echo '<ul>';
                    foreach ($game as $key => $value) {
                        echo '<li>';
                        echo transl(corr($key)) . ' : ' . $value;
                        echo '</li>';
                    }
                    echo '</ul>';
                    echo '</div>';
                    if ($counter % 2 == 0)
                        echo '</div>';
                }
                ?>
                <div class="row">
                    <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12 col-md-offset-1 col-lg-offset-1 col-sm-offset-1">

                    </div>
                    <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12 col-md-offset-1 col-lg-offset-1 col-sm-offset-1">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12 col-md-offset-1 col-lg-offset-1 col-sm-offset-1">

                    </div>
                    <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12 col-md-offset-1 col-lg-offset-1 col-sm-offset-1">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12 col-md-offset-1 col-lg-offset-1 col-sm-offset-1">
                    </div>
                    <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12 col-md-offset-1 col-lg-offset-1 col-sm-offset-1">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12 col-md-offset-1 col-lg-offset-1 col-sm-offset-1">
                    </div>
                    <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12 col-md-offset-1 col-lg-offset-1 col-sm-offset-1">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12 col-md-offset-1 col-lg-offset-1 col-sm-offset-1">
                    </div>
                    <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12 col-md-offset-1 col-lg-offset-1 col-sm-offset-1">
                    </div>
                </div>
            </div>
        </div>

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
                    if (jsonObj.friends[curFriend].online == true) {
                        table.append('<tr onclick="toFriend(this)" class="frrow success">' +
                            '<th scope="row" id="curnamefr">' + jsonObj.friends[curFriend].name + '</th>' +
                            '<td>' + jsonObj.friends[curFriend].server + '</td>' +
                            '<td>' + ((jsonObj.friends[curFriend].online == true) ? 'Сейчас' : parseTime(jsonObj.friends[curFriend].last_exit_time)) + '</td>'
                            + '</tr>'
                        );
                    } else {
                        table.append('<tr onclick="toFriend(this)" class="frrow" style="background:#f5f5f5;">' +
                            '<th scope="row" id="curnamefr">' + jsonObj.friends[curFriend].name + '</th>' +
                            '<td>' + jsonObj.friends[curFriend].server + '</td>' +
                            '<td>' + ((jsonObj.friends[curFriend].online == true) ? 'Сейчас' : parseTime(jsonObj.friends[curFriend].last_exit_time)) + '</td>'
                            + '</tr>'
                        );
                    }

                }
            });
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
