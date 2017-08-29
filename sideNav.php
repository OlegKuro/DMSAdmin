<!-- IMPORTANT PLACE WHOLE PAGE IN DIV#MAIN -->
<style>
    body {
        font-family: "Lato", sans-serif;
    }

    .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 40px;
    }

    .sidenav a {
        padding: 8px 8px 8px 16px;
        text-decoration: none;
        font-size: 17px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidenav a:hover, .offcanvas a:focus {
        color: #333;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 24px;
        margin-left: 50px;
    }

    #main {
        transition: margin-left .5s;
        padding: 16px;
    }

    @media screen and (max-height: 450px) {
        .sidenav {
            padding-top: 15px;
        }

        .sidenav a {
            font-size: 12px;
        }
    }

    #ctrler {
        position: fixed;
        z-index: 200;
        left: 10px;
        cursor: pointer;
        color: black;
        top: 50%;
        opacity: 0.6;
        transition: left .8s, transform .8s, color .8s, top .8s;
    }

    #cross {
        position: fixed;
        z-index: 200;
        left: 0;
        top: 0;
        transition: color .8s;
        color: white;
        opacity: 0.6;
        cursor: pointer;
        display: none;
    }

    #cross:hover {
        color: red;
    }

    #logo {
        padding: 10px;
        display: block;
        transition: 0.3s;
        text-decoration: none;
        filter: grayscale(100%);
    }
</style>

<div id="mySidenav" class="sidenav">

    <a href="https://dms.yt/" id="logo"><img src="pics/logo.png" height="180" width="180" alt=""></a>
    <a href="profile.php">Мой профиль</a>
    <a href="servStats.php">Статистика сервера</a>
    <a href="proxies.php">Нагрузка</a>
    <a href="staff.php">Персонал</a>
    <a href="lists.php">Поиск игрока</a>
    <a href="https://api.dms.yt">Разработчикам</a>

    <i class="fa fa-times fa-3x" aria-hidden="true" onclick="logout()" id="cross"></i>
    <div class="downcontacts">

    </div>
</div>

<i class="fa fa-angle-double-right fa-3x" id="ctrler" aria-hidden="true" onclick="navalniy(this)"></i>

<script>
    function navalniy(el) {
        if (document.getElementById("mySidenav").style.width == "200px") {
            closeNav(el);
            $('#cross').fadeOut('slow');
        }
        else {
            openNav(el);
            $('#cross').fadeIn('slow');
        }
    }

    function logout() {
        window.location = 'logout.php';
    }

    function openNav(el) {
        document.getElementById("mySidenav").style.width = "200px";
        document.getElementById("main").style.marginLeft = "200px";
        el.style.left = "160px";
        el.style.opacity = "0.6";
        el.style.top = "0";
        el.style.color = "white";
        el.style.transform = "rotate(180deg)";
    }

    function closeNav(el) {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        el.style.opacity = "0.6";
        el.style.left = "10px";
        el.style.top = "50%";
        el.style.color = "black";
        el.style.transform = "rotate(0deg)";
    }
</script>