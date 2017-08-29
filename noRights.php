<?php
/**
 * Created by PhpStorm.
 * User: kuro
 * Date: 29.08.17
 * Time: 6:36
 */
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
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:300,900">
<style>
    html,
    body {
        height: 100%;
    }

    body {
        color: #4c4a50;
        font: 300 1em/1.5em "Lato", sans-serif;
        margin: 0;
        position: relative;
    }

    h1 {
        font-size: 2em;
        font-weight: 900;
        line-height: 1.1em;
        margin: 0;
    }

    h2 {
        font-size: 1.5em;
        font-weight: 300;
        line-height: 1.1em;
        margin: 0;
    }

    svg {
        height: auto;
        max-width: 100%;
    }

    .container {
        left: 50%;
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .display-table {
        display: table;
        width: 100%;
    }

    .display-table-cell {
        display: table-cell;
        vertical-align: middle;
    }

    .icons {
        display: none;
    }

    .icon {
        display: inline-block;
        height: 3em;
        width: 3em;
    }

    .icon-left {
        margin-right: 1em;
    }

    .icon-right {
        margin-left: 1em;
    }

    .icon-x {
        background-color: #ca2735;
        border-radius: 50%;
        fill: white;
        padding: .5em;
    }

    .page-404 {
        background: radial-gradient(ellipse farthest-side at right top, #2ca6e0 0%, #1766b3 100%) no-repeat;
    }

    .message {
        background-color: white;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        padding: 1em 2em;
        text-transform: uppercase;
    }

    .message h1 {
        font-weight: 900;
    }

    .message h2 {
        font-weight: 300;
    }

    .animated {
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }

    .bounceIn {
        -webkit-animation-name: bounceIn;
        animation-name: bounceIn;
        -webkit-animation-duration: .75s;
        animation-duration: .75s;
    }

    @-webkit-keyframes bounceIn {
        0%, 20%, 40%, 60%, 80%, 100% {
            transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
        }

        0% {
            opacity: 0;
            transform: scale3d(0.3, 0.3, 0.3);
        }

        20% {
            transform: scale3d(1.1, 1.1, 1.1);
        }

        40% {
            transform: scale3d(0.9, 0.9, 0.9);
        }

        60% {
            opacity: 1;
            transform: scale3d(1.03, 1.03, 1.03);
        }

        80% {
            transform: scale3d(0.97, 0.97, 0.97);
        }

        100% {
            opacity: 1;
            transform: scale3d(1, 1, 1);
        }
    }

    @keyframes bounceIn {
        0%, 20%, 40%, 60%, 80%, 100% {
            transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
        }

        0% {
            opacity: 0;
            transform: scale3d(0.3, 0.3, 0.3);
        }

        20% {
            transform: scale3d(1.1, 1.1, 1.1);
        }

        40% {
            transform: scale3d(0.9, 0.9, 0.9);
        }

        60% {
            opacity: 1;
            transform: scale3d(1.03, 1.03, 1.03);
        }

        80% {
            transform: scale3d(0.97, 0.97, 0.97);
        }

        100% {
            opacity: 1;
            transform: scale3d(1, 1, 1);
        }
    }

</style>


<body class="page-404">

<div class="container">

    <div class="message animated bounceIn">

        <div class="display-table">

            <div class="display-table-cell">

                <svg class="icon icon-left icon-x">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-x"></use>
                </svg>

            </div>

            <div class="display-table-cell">

                <h1>Нет Доступа</h1>
                <br>
                <h2>Ха-ха! Ты всего лишь <i><?php echo $_SESSION['group'] ?>?!</i></h2>
                <br>
                <h2>Уходи отсюда, сталкер!</h2>

            </div>

        </div>

    </div>

</div>

<svg class="icons" xmlns="http://www.w3.org/2000/svg">
    <symbol viewBox="0 0 512 512" id="icon-x"><title>x</title>
        <path d="M438.393 374.595L319.757 255.977l118.62-118.63-63.782-63.74-118.6 118.618-118.62-118.603-63.768 63.73 118.64 118.63L73.62 374.626l63.73 63.768 118.65-118.66 118.65 118.645z"/>
    </symbol>
</svg>

</body>


