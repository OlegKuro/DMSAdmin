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
        padding-top: 60px;
    }

    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 22px;
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
        font-size: 36px;
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
            font-size: 18px;
        }
    }

    #ctrler {
        position: fixed;
        z-index: 200;
        left: 20px;
        cursor: pointer;
        color: black;
        top: 50%;
        opacity: 0.6;
        transition: left .8s, transform .8s;
    }
</style>

<div id="mySidenav" class="sidenav">
    <a href="admin.php">Server info</a>
    <a href="owner.php">My Page</a>
    <a href="#">DMS.YT...</a>
    <a href="#">Contacts</a>
</div>

<i class="fa fa-angle-double-right fa-2x" id="ctrler" aria-hidden="true" onclick="navalniy(this)"></i>

<script>
    function navalniy(el) {
        if (document.getElementById("mySidenav").style.width == "200px")
            closeNav(el);
        else
            openNav(el);
    }

    function openNav(el) {
        document.getElementById("mySidenav").style.width = "200px";
        document.getElementById("main").style.marginLeft = "200px";
        el.style.left = "205px";
        el.style.opacity = "1";
        el.style.transform = "rotate(180deg)";
    }

    function closeNav(el) {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        el.style.opacity = "0.6";
        el.style.left = "20px";
        el.style.transform = "rotate(0deg)";
    }
</script>