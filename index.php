<?php
require "header.php";

?>
<style>
    body {
        padding-top: 120px;
        padding-bottom: 40px;
        background-color: #eee;

    }

    .btn {
        outline: 0;
        border: none;
        border-top: none;
        border-bottom: none;
        border-left: none;
        border-right: none;
        box-shadow: inset 2px -3px rgba(0, 0, 0, 0.15);
    }

    .btn:focus {
        outline: 0;
        -webkit-outline: 0;
        -moz-outline: 0;
    }

    .fullscreen_bg {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-size: cover;
        background-position: 50% 50%;
        background-image: url('http://cleancanvas.herokuapp.com/img/backgrounds/color-splash.jpg');
        background-repeat: repeat;
    }

    .form-signin {
        max-width: 280px;
        padding: 15px;
        margin: 0 auto;
        margin-top: 50px;
    }

    .form-signin .form-signin-heading, .form-signin {
        margin-bottom: 10px;
    }

    .form-signin .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .form-signin .form-control:focus {
        z-index: 2;
    }

    .form-signin input[type="text"] {
        margin-bottom: -1px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        border-top-style: solid;
        border-right-style: solid;
        border-bottom-style: none;
        border-left-style: solid;
        border-color: #000;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-top-style: none;
        border-right-style: solid;
        border-bottom-style: solid;
        border-left-style: solid;
        border-color: rgb(0, 0, 0);
        border-top: 1px solid rgba(0, 0, 0, 0.08);
    }

    .form-signin-heading {
        color: #fff;
        text-align: center;
        text-shadow: 0 2px 2px rgba(0, 0, 0, 0.5);
    }
</style>
<div id="fullscreen_bg" class="fullscreen_bg"/>

<div class="container">

    <form class="form-signin" action="auth.php" method="post">
        <h1 class="form-signin-heading text-muted">AdminStats</h1>
        <input type="text" name="login" class="form-control" placeholder="Nickname" required="" autofocus="">
        <input type="password" name="pass" class="form-control" placeholder="Password" required="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">
            Войти
        </button>
    </form>
</div>
<small id="smallauth" style="    display: block;
    margin: 0 auto;
    text-align: center;
    padding-left: 0;
    letter-spacing: 2px;
    text-transform: uppercase;
color: #f08d8c;"><?php
                            switch ($_GET['resp']) {
                                case -2:
                                    echo 'wrong login or password';
                                    break;
                                case -1:
                                    echo 'empty login/pass';
                                    break;
                                case -3:
                                    echo 'You should authorise';
                                    break;
                            }


                            ?></small>

    <script type="text/javascript" src="js/index.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
</html>