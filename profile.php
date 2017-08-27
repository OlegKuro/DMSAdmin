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

    .nupizdateper {
        color: #ff383d;
        font-weight: bold !important;
        font-size: 17px !important;
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
        text-align: center;
    }

    #gamesInfoLabel {
        text-transform: uppercase;
        font-size: 20px;
        font-weight: 200;
        color: black;
        letter-spacing: 5px;
    }

    .frrow {
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
        <div class="container" id="main-cont">
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
                <button type="button" class="btn btn-default" onclick="updForc(this)"
                        style="margin: 0 auto; cursor:pointer;">Обновить
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
                    <div class="row" style="min-height:180px">
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
                            <input type="text" class="form-control" id="usr" placeholder="<?php
                            if (isset($_GET) || $_GET != '') {
                                echo $_GET['player'];
                            } else {
                                echo $_SESSION['name'];
                            }
                            ?>">
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-8 col-sm-6 col-xs-12 gamesInfo">
                    <?php
                    require_once "utilsession.php";
                    $temp = new utilsession();
                    if (isset($_GET) || $_GET != '') {
                        $url = $temp->api_req . "player.getGeneralInfo?token=" . $temp->token . '&player=' . $_GET['player'];
                    } else {
                        $url = $temp->api_req . "player.getGeneralInfo?token=" . $temp->token . '&player=' . $_SESSION['name'];
                    }
                    $json = file_get_contents($url);
                    $json = json_decode($json, true);
                    $counter = 0;
                    echo '<script>';
                    echo 'function newTitle(){document.title = "' . ((isset($_GET["player"]) && $_GET["player"] != "") ? $_GET["player"] : $_SESSION["name"]) . '"}';
                    echo '</script>';
                    function checkIfBool($tested)
                    {
                        if (is_bool($tested)) {
                            if ($tested == true) {
                                return 'да';
                            };
                            if ($tested == false) {
                                return 'нет';
                            }
                        } else
                            return $tested;
                    }

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
                            if ($key == 'main_group_localized') {
                                echo '<script>';
                                echo 'function kostil(){
                            document.getElementById("curUserGr").innerHTML = "' . $value .
                                    '";
                            }';
                                echo '</script>';
                                continue;
                            };
                            if ($key == 'main_group') {
                                echo '<li>';
                                echo 'ГЛАВНАЯ ГРУППА : ';
                                echo corr($game['main_group_localized']);
                                echo '</li>';
                                continue;
                            }
                            if ($key == 'all_groups') {
                                $sooqa = $value;
                                echo transl($key) . ' : ';
                                $ctr = 0;
                                foreach ($sooqa as $fuckMyMozg) {
                                    $ctr++;
                                    if ($ctr == count($sooqa)) {
                                        echo $fuckMyMozg;
                                    } else {
                                        echo $fuckMyMozg . ', ';
                                    }
                                };
                                continue;
                            };
                            if ($key == 'last_exit_time' || $key == 'mute_end' || $key == 'ban_end') {
                                $value = intdiv($value, 1000) + 10800;
                                $value = gmdate("Y-m-d H:i:s", $value);
                                $value;
                            };
                            switch (transl(corr($key))) {
                                case 'выход из мута':
                                case 'причина мута':
                                case 'мут дал':
                                case 'выход из бана':
                                case 'причина бана':
                                case 'бан дал':
                                    echo '<li class="nupizdateper">';
                                    break;

                                default:
                                    echo '<li>';
                                    break;
                            }
                            echo transl(corr($key)) . ' : ' . checkIfBool($value);
                            echo '</li>';
                        }
                        echo '</ul>';
                        echo '</div>';
                        if ($counter % 2 == 0 || $counter == 5)
                            echo '</div>';
                    }
                    ?>
                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 gamesInfo" style="text-align: center !important;">
                <span id="gamesInfoLabel">
                    Статистика игр
                </span>
                    <?php
                    function corr($input)
                    {
                        return str_replace("_", " ", $input);
                    }

                    function transl($input)
                    {
                        switch ($input) {
                            case 'experience':
                                return 'опыт';
                                break;
                            case 'rank in guild':
                                return 'ранг в гильдии';
                                break;
                            case 'guild name':
                                return 'название гильдии';
                                break;
                            case 'guild gold':
                                return 'золото гильдии';
                                break;
                            case 'guild id':
                                return 'ID гильдии';
                                break;
                            case 'guild level':
                                return 'уровень гильдии';
                                break;
                            case 'guild experience':
                                return 'опыт гильдии';
                                break;
                            case 'in guild':
                                return 'участников гильдии';
                                break;
                            case 'main group':
                                return 'главная группа';
                                break;
                            case 'server':
                                return 'сервер';
                                break;
                            case 'online':
                                return 'онлайн';
                                break;
                            case 'total bans':
                                return 'банов получено';
                                break;
                            case 'total mutes':
                                return 'мутов получено';
                                break;
                            case 'banned':
                                return 'в бане';
                                break;
                            case 'mute reason':
                                return 'причина мута';
                                break;
                            case 'mute end':
                                return 'выход из мута';
                                break;
                            case 'mute enforcer':
                                return 'мут дал';
                                break;
                            case 'ban enforcer':
                                return 'бан дал';
                                break;
                            case 'ban end':
                                return 'выход из бана';
                                break;
                            case 'ban reason':
                                return 'причина бана';
                                break;
                            case 'muted':
                                return 'в муте';
                                break;
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
                            case 'last exit time':
                                return 'последний раз в сети';
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
                                return 'solo убийств';
                                break;
                            case 'quadro kills':
                                return 'quadro убийств';
                                break;
                            case 'octo kills':
                                return 'octo убийств';
                                break;
                            case 'octo wins':
                                return 'octo побед';
                                break;
                            case 'solo wins':
                                return 'solo побед';
                                break;
                            case 'quadro wins':
                                return 'quadro побед';
                                break;
                            case 'duo wins':
                                return 'duo побед';
                                break;
                            case 'all_groups':
                                return 'все группы';
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
            newTitle();
            kostil();
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
            var formattedTime = day + '.' + month + ' ' + hours + ':' + minutes.substr(-2);
            return formattedTime;
        }
    </script>
    <?php
    require "footer.php";
    ?>
