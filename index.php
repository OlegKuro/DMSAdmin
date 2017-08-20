<?php
require "header.php";
session_start();

?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-xs-4 col-lg-4 col-sm-4">
            </div>
            <div class="col-md-4 col-xs-4 col-lg-4 col-sm-4">
                <form action="auth.php" method="post" class="authForm">
                    <div class="form-group">
                        <h2 id="formh1">Authorisation</h2>
                        <label for="log"></label>
                        <input type="text" id="log" class="form-control" name="login" placeholder="login"/>
                        <label for="pass"></label>
                        <input type="password" name="pass" placeholder="password" id="pass" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-primary">Log in</button>
                        <small id="smallauth"><?php
                            if ($_GET['resp'] == -2) {
                                echo 'wrong login or password';
                            } else
                                if ($_GET['resp'] == -1) {
                                    echo 'empty login/pass';
                                }
                            ?></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
require "footer.php"
?>