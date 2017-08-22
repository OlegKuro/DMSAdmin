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
        require_once "utilsession.php";
        $temp = new utilsession();
        $url = $temp->api_req . "project.getStaffOnline?token=" . $temp->token;
        $json = file_get_contents($url);
        $json = json_decode($json, true);
        $counter = 0;
        foreach ($json as $key => $val1) {
            foreach ($val1 as $num => $person) {
                foreach ($person as $attr => $name) {
                    $group = $key;
                    switch ($attr) {
                        case 'server':
                            $server = $name;
                            break;
                        case 'nickname':
                            $nick = $name;
                            if ($counter < 5) {
                                echo '<tr style="cursor: none">
        <th scope="row">' . $group . '</th>
        <td><i>'. $nick .'</i></td>
        <td>'. $server . '</td>
        </tr>';
                            }
                            if ($counter == 5) {
                                echo '<tr data-toggle="collapse" class="clickable"
data-target=".accordion" style="cursor:pointer;">
        <th scope="row">' . $group . '</th>
        <td><i>'. $nick .'</i></td>
        <td>'. $server . '</td>
        </tr>';

                            }
                            if ($counter > 5) {
                                echo '<tr style="cursor:none;" class="accordion collapse">
        <th scope="row">' . $group . '</th>
        <td><i>'. $nick .'</i></td>
        <td>'. $server . '</td>
        </tr>';
                            }

                            ++$counter;
                            break;
                    }
                }
            }
        }

        unset($temp);
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