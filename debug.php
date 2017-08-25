<?php

function parseTime($time)
{
    $time = intdiv($time, 1000) + 10800;
    $time = gmdate("Y-m-d H:i:s", $time);
    return $time;
}

;

echo parseTime(1503625325866);
