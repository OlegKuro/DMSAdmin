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
        border-radius: 10px;
        color: white;

        padding: 1px 3px;
        font-size: 10px;

        position: absolute; /* Position the badge within the relatively positioned button */
        top: 10px;
        right: 2px;
    }

    .frrow {
        margin: 0 auto;
        background-color: #e9e9e9;
        width: 100%;
        text-align: center;
        display: inline;
        height: 22px;
        letter-spacing: 1px;
        font-size: 14px;
        border-bottom: #e6e6e6 0.5px solid;
        font-weight: 300;
        cursor: pointer;
    }

    .success {
        background-color: #c3ffc3 !important;
    }

    .titlo {
        border-radius: 12px;
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

    .mrow {
        font-size: 26px;
        margin: 0 auto;
        margin-bottom: 0px;
        margin-left: auto;
        height: 44px;
        border-radius: 20px;
        margin-bottom: 5px;
        margin-left: 65px;
    }

    #headergr {
        display: block;
        margin: 11px auto;
        padding: 4px;
        padding-top: 4px;
        padding-bottom: 4px;
        padding-left: 4px;
        padding-left: 4px;
        padding-left: 65px;
        letter-spacing: 14px;
        font-size: 22px;
        color: #8787f1;
        font-weight: 300;
        padding-bottom: 20px;
        padding-top: 12px;
    }

    #blednavalniy {
        display: inline-block;
        margin: 11px auto;
        letter-spacing: 3px;
        font-size: 22px;
        text-transform: uppercase;
        color: #8787f1;
        font-weight: 300;
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
            <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12" style="text-align: center">
                    <div class="row" id="blednavalniy">
                        Группы пользователей
                    </div>
                    <div class="titlo row" onclick="foo(this)" id="SRMODERATOR">

                    </div>
                    <div class="SRMODERATOR row" id="1row"></div>
                    <div class="titlo row" onclick="foo(this)" id="DEVELOPER">

                    </div>
                    <div class="DEVELOPER row" id="2row"></div>
                    <div class="titlo row" onclick="foo(this)" id="SRBUILDER">

                    </div>
                    <div class="SRBUILDER row" id="3row"></div>
                    <div class="titlo row" onclick="foo(this)" id="HELPER">

                    </div>
                    <div class="HELPER row" id="4row"></div>
                    <div class="titlo row" onclick="foo(this)" id="JRBUILDER">

                    </div>
                    <div class="row JRBUILDER" id="5row"></div>
                    <div class="titlo row" onclick="foo(this)" id="YOUTUBE">

                    </div>
                    <div class="row YOUTUBE" id="6row"></div>
                    <div class="titlo row" onclick="foo(this)" id="SPECIAL">

                    </div>
                    <div class="row SPECIAL" id="7row"></div>
                    <div class="titlo row" onclick="foo(this)" id="BETA">

                    </div>
                    <div class="row BETA" id="8row"></div>
                    <div class="titlo row" onclick="foo(this)" id="PLAYER">

                    </div>
                    <div class="row PLAYER" id="9row"></div>
                    <div class="titlo row" onclick="foo(this)" id="QA">

                    </div>
                    <div class="row QA" id="10row"></div>
                    <div class="titlo row" onclick="foo(this)" id="ADMINISTRATOR">

                    </div>
                    <div class="row ADMINISTRATOR" id="11row"></div>
                    <div class="titlo row" onclick="foo(this)" id="OWNER">

                    </div>
                    <div class="row OWNER" id="12row"></div>
                    <div class="titlo row" onclick="foo(this)" id="VIP_PLUS">


                    </div>
                    <div class="row VIP_PLUS" id="13row"></div>
                    <div class="titlo row" onclick="foo(this)" id="BUILDER">

                    </div>
                    <div class="row BUILDER" id="14row"></div>
                    <div class="titlo row" onclick="foo(this)" id="YOUTUBE_PLUS_PLUS">

                    </div>
                    <div class="row YOUTUBE_PLUS_PLUS" id="15row"></div>
                    <div class="titlo row" onclick="foo(this)" id="RICH">

                    </div>
                    <div class="row RICH" id="16row"></div>
                    <div class="titlo row" onclick="foo(this)" id="VIP">

                    </div>
                    <div class="row VIP" id="17row"></div>
                    <div class="titlo row" onclick="foo(this)" id="YOUTUBE_PLUS">

                    </div>
                    <div class="row YOUTUBE_PLUS" id="18row"></div>
                    <div class="titlo row" onclick="foo(this)" id="RICH_PLUS">

                    </div>
                    <div class="row RICH_PLUS" id="19row" onclick="foo(this)"></div>
                    <div class="titlo row" onclick="foo(this)" id="MODERATOR">

                    </div>
                    <div class="row MODERATOR" id="20row"></div>

                </div>
                <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12 col-md-offset-1 col-lg-offset-1">
                    <div class="row personal">

                    </div>
                </div>
            </div>

        </div>

        <script>
            function foo(el) {
                console.log("clicked");
                var sele = "." + el.id + ' div';
                if ($(sele).length != 0) {
                    $(sele).slideUp('slow');
                    console.log('closing');
                    setTimeout(function () {
                        $(sele).remove();
                    }, 1000);
                }
                else {
                    console.log('fetchin');
                    var number = 1;
                    //toka online
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
                        for (key in jsonObj[el.id]) {
                            $(div).append('<div onclick="toFriend(this)" class="frrow row success" style="display: none;" id=' + jsonObj[el.id][parseInt(key)]['nickname'] + '>' + jsonObj[el.id][parseInt(key)]['nickname'] + ' ' + jsonObj[el.id][parseInt(key)]['server'] + '</div>');
                        }
                        var sele = "." + el.id + ' div';
                        console.log('online fetched');
                        $(sele).slideDown();
                        setTimeout(function () {
                            close(el);
                            console.log('timer to close');
                        }, 10000);
                    });
                }
                $.get("server.php?func=gdeMoyGrob", function (data) {
                    var gr = el.id; //string group
                    data = $.parseJSON(data);
                    console.log(data[gr]);
                    $(".personal").html('');
                    $(".personal").append('<span id="headergr">' + gr + '</span>');
                    for (var kek in data[gr]) {
                        (function () {
                            var name = data[gr][kek];
                            $.get("server.php?func=gdeLeha&player=" + name, function (Leha) {
                                Leha = $.parseJSON(Leha);
                                if (Leha['is_online']) {
                                    $(".personal").append('<div onclick="toFriend(this)" class="frrow row mrow success" id="' + name + '">' + name + '</div>');
                                } else {
                                    $(".personal").append('<div onclick="toFriend(this)" class="frrow row mrow" id="' + name + '">' + name + '</div>');
                                }
                            })
                        })();


                    }
                })
            }

            function close(el) {
                var sele = "." + el.id + ' div';
                $(sele).slideUp('slow');
                console.log('closing');
                setTimeout(function () {
                    $(sele).remove();
                }, 1000);
            }

            function toFriend(rw) {
                var k = rw.id;
                window.location.href = "owner.php?player=" + k;
            }

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
                setInterval(notify, 10000);
                foo(document.getElementById('OWNER'));
            });

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
