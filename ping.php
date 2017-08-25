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
 * Date: 25.08.17
 * Time: 7:48
 */
require "header.php";
require "sideNav.php"
?>
<style>
    .button__badge {
        background-color: #fa3e3e;
        border-radius: 2px;
        color: white;

        padding: 1px 3px;
        font-size: 10px;

        position: absolute; /* Position the badge within the relatively positioned button */
        top: -7px;
        right: -5px;
    }

    .titlo {
        padding: 11px;
        padding-top: 7px;
        background: rgb(255, 255, 255); /* Old browsers */
        background: -moz-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(241, 241, 241, 1) 50%, rgba(225, 225, 225, 1) 51%, rgba(246, 246, 246, 1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(241, 241, 241, 1) 50%, rgba(225, 225, 225, 1) 51%, rgba(246, 246, 246, 1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom, rgba(255, 255, 255, 1) 0%, rgba(241, 241, 241, 1) 50%, rgba(225, 225, 225, 1) 51%, rgba(246, 246, 246, 1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        position: relative;
        display: block;
        text-align: center;
        cursor: pointer;
    }

    .groupLabel {
        margin 0 auto;
    }
</style>
<div id="main">
    <div class="container">

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
            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                <div class="titlo row" onclick="foo(this)" id="SRMODERATOR">

                </div>
                <div class="row" id="1row"></div>
                <div class="titlo row" onclick="foo(this)" id="DEVELOPER">

                </div>
                <div class="row" id="2row"></div>
                <div class="titlo row" onclick="foo(this)" id="SRBUILDER">

                </div>
                <div class="row" id="3row"></div>
                <div class="titlo row" onclick="foo(this)" id="HELPER">

                </div>
                <div class="row" id="4row"></div>
                <div class="titlo row" onclick="foo(this)" id="JRBUILDER">

                </div>
                <div class="row" id="5row"></div>
                <div class="titlo row" onclick="foo(this)" id="YOUTUBE">

                </div>
                <div class="row" id="6row"></div>
                <div class="titlo row" onclick="foo(this)" id="SPECIAL">

                </div>
                <div class="row" id="7row"></div>
                <div class="titlo row" onclick="foo(this)" id="BETA">

                </div>
                <div class="row" id="8row"></div>
                <div class="titlo row" onclick="foo(this)" id="PLAYER">

                </div>
                <div class="row" id="9row"></div>
                <div class="titlo row" onclick="foo(this)" id="QA">

                </div>
                <div class="row" id="10row"></div>
                <div class="titlo row" onclick="foo(this)" id="ADMINISTRATOR">

                </div>
                <div class="row" id="11row"></div>
                <div class="titlo row" onclick="foo(this)" id="OWNER">

                </div>
                <div class="row" id="12row"></div>
                <div class="titlo row" onclick="foo(this)" id="VIP_PLUS">


                </div>
                <div class="row" id="13row"></div>
                <div class="titlo row" onclick="foo(this)" id="BUILDER">

                </div>
                <div class="row" id="14row"></div>
                <div class="titlo row" onclick="foo(this)" id="YOUTUBE_PLUS_PLUS">

                </div>
                <div class="row" id="15row"></div>
                <div class="titlo row" onclick="foo(this)" id="RICH">

                </div>
                <div class="row" id="16row"></div>
                <div class="titlo row" onclick="foo(this)" id="VIP">

                </div>
                <div class="row" id="17row"></div>
                <div class="titlo row" onclick="foo(this)" id="YOUTUBE_PLUS">

                </div>
                <div class="row" id="18row"></div>
                <div class="titlo row" onclick="foo(this)" id="RICH_PLUS">

                </div>
                <div class="row" id="19row" onclick="foo(this)"></div>
                <div class="titlo row" id="MODERATOR">

                </div>
                <div class="row" onclick="foo(this)" id="20row"></div>

            </div>
        </div>

        <script>
            function foo(el) {
                var number = 1;
                $.get("server.php?func=yaZaebalsya", function (data) {
                    var jsonObj = $.parseJSON(data);
                    var keys = Object.keys(jsonObj);
                    for (var key in keys) {
                        if (keys[key] === el.id) {
                            break;
                        }
                        number++;
                    }
                    var div = $('#' + number + 'row');
                    //here we have a number of item
                    var times = 0;
                    console.log(jsonObj[el.id][0]['nickname']);
                    for (key in jsonObj[el.id]) {
                        if (times == 0) {
                            $(div).append('<table class="table table-sm table-hover table-condensed" id="friendsTable"><thead>' + '<tr><th></th><th></th><th></th></tr></thead><tbody><tr>' +
                                '<th><th><td></td><td></td></tr>');
                        }
                        $(div).append('<tr onclick="toFriend(this)" class="frrow success">');
                        $(div).append('<th scope="row" id="curnamefr">');
                        $(div).append(jsonObj[el.id][parseInt(key)]['nickname'] + '</th><td>');
                        $(div).append(jsonObj[el.id][parseInt(key)]['server'] + '</td><td>ОНЛАЙН</td></tr>');
                        ++times;
                        if (times == jsonObj[el.id].length) {
                            $(div).append('</tbody></table>');
                        }
                    }

                });
            };
            function notify() {
                $.get("server.php?func=yaZaebalsya", function (data) {
                    $(".titlo>.button__badge").remove();
                    var jsonObj = $.parseJSON(data);
                    for (var type in jsonObj) {
                        if (jsonObj[type].length > 0) {
                            var s = '<span class="button__badge">';
                            s += ('' + jsonObj[type].length);
                            s += '</span>';
                            var element = document.getElementById(type);
                            $(element).append(s);
                        }
                    }
                });

            }
            $(document).ready(function () {
                $(".titlo").each(function () {
                    this.innerHTML = '<span class="groupLabel">' + this.id + '</span>';
                });
                notify();
                setInterval(notify, 3000);
            });
        </script>
        <?php
        require "footer.php";
        ?>
