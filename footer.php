<hr style="
    border: none;
    height: 1px;
    /* Set the hr color */
    color: #cbd9ef; /* old IE */
    background-color: #cbd9ef; /* Modern Browsers */
 ">

<div class="container">
    <footer class="footer-bs">
        <div class="row">
            <div class="span6 formh2" style="float: none; margin: 0 auto;">Администрация проекта:</div>
        </div>
        <hr>

        <?php
        for ($i = 0; $i < 10; $i++) {
            echo "<div class=\"row icon_holder footer-social animated fadeInDown\">
			<div class=\"col-xs-1 col-md-1 col-sm-1 col-lg-1 icon_inner\">
				<i class=\"fa fa-circle colored-circle\"></i>
			</div>
			<div class=\"col-xs-2 col-sm-2 col-md-2 col-lg-2\">
				<span id=\"admfoot\"><i>RINES</i></span>
			</div>
			<div class=\"col-md-offset-1 col-lf-offset-1 col-sm-offset-1 col-xs-8 col-sm-8 col-lg-8 col-md-8\">Administrator info</div>
		</div>";
        }

        ?>


    </footer>
</div>


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