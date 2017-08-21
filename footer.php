<hr style="
    border: none;
    height: 1px;
    /* Set the hr color */
    color: #cbd9ef; /* old IE */
    background-color: #cbd9ef; /* Modern Browsers */
 ">

<div class="container">
    <div class="row">
        <div class="span6 formh2" style="float: none; margin: 0 auto;">Администрация проекта:</div>
    </div>
    <hr>
    <table class="table table-sm table-hover" style="margin-bottom: 30px;">
        <thead>
        <tr>
            <th>Type</th>
            <th>NickName</th>
            <th>Server</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i < 5; $i++){
            $def = rand(0,1);
            switch ($def){
                case 0:
                    echo '<tr class="table-success">
            <th scope="row">Developer</th>
            <td><i>RINES</i></td>
            <td>Our god and main developer</td>
        </tr>';
                    break;
                case 1:
                    echo '<tr class="table-danger">
            <th scope="row">Admin</th>
            <td><i>RINES</i></td>
            <td>Our god and main developer</td>
        </tr>';
                    break;
            }
        }
        echo '<tr data-toggle="collapse" class="table-active clickable"
data-target=".accordion">
        <th scope="row">Kostik :3</th>
        <td><i>RINES</i></td>
        <td>Nazhmi na etu stroku to see moar</td>
        </tr>';

        for ($i=0; $i < 20; $i++){
            $def = rand(0,1);
            switch ($def){
                case 0:
                    echo '<tr class="table-success accordion collapse">
            <th scope="row">Developer</th>
            <td><i>RINES</i></td>
            <td>Our god and main developer</td>
        </tr>';
                    break;
                case 1:
                    echo '<tr class="table-danger accordion collapse">
            <th scope="row">Admin</th>
            <td><i>RINES</i></td>
            <td>Our god and main developer</td>
        </tr>';
                    break;
            }
        }

        ?>

        </tbody>
    </table>
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