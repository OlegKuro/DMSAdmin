<?php
require "header.php";

?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-xs-4 col-lg-4 col-sm-4">
            </div>
            <div class="col-md-4 col-xs-4 col-lg-4 col-sm-4">
                <form action="auth.php" method="post" class="authForm" id="formToSend">
                    <div class="form-group">
                        <h2 id="formh1">Authorisation</h2>
                        <label for="log"></label>
                        <input type="text" id="log" class="form-control" name="login" placeholder="login"/>
                        <label for="pass"></label>
                        <input type="password" name="pass" placeholder="password" id="pass" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-primary">Log in</button>
                        <small id="smallauth"><?php
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
                    </div>
                </form>
            </div>
        </div>
    </div>

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