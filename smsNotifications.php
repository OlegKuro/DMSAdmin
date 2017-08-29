<?php
/**
 * Created by PhpStorm.
 * User: kuro
 * Date: 28.08.17
 * Time: 22:01
 */
// Require the bundled autoload file - the path may need to change
// based on where you downloaded and unzipped the SDK
require __DIR__ . '/twilio-php-master/Twilio/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$client = new Client($sid, $token);
$numsarr = [
    '+79119834268',
    '+12312412321',
    '+21343124535'
];

$fd1 = fopen("smsData/toSend.pdr", "r");
$fd2 = fopen("smsData/sent.pdr", "r");


$date = new DateTime();
$scriptTime = $date->getTimestamp(); //sceonds

require 'utilsession.php';
$kek = new utilsession();
$url = $kek->api_req . 'project.getMachinesLoad?token=' . $kek->token;
$json = file_get_contents($url);
$json = json_decode($json, true);
$json = $json['machines'];
$t = array();
$a = array();
foreach ($json as $value) {
    if ($value['load_percentage'] >= 110) {
        array_push($a, ($value['name']));
        array_push($t, $scriptTime);
    }
}
/* calulations */
$a = array_combine($a, $t);
$b = readArr($fd1);
$c = readArr($fd2);
fclose($fd1);
fclose($fd2);
$a = array_diff_key($a, $c);
$b = array_intersect_key($b, $a);
$a = array_diff_key($a, $b);
$b = array_merge($b, $a);

$newb = array();
/*manipulations and transfers (b->c->o) */
# P.S. don't forget to send SMS
foreach ($b as $key => $keyTime) {
    if ($keyTime - $scriptTime >= 300) {
        //this item ment to be sent
        $c = array_merge($c, [$key => $keyTime]);
    } else {
        $newb = array_merge($newb, [$key => $keyTime]);
    }
}
$b = $newb;
unset($newb);

$newc = array();
foreach ($c as $key => $keyTime) {
    if ($keyTime - $scriptTime < 1200) {
        $newc = array_merge($newc, [$key => $keyTime]);
    }
}
$c = $newc;
unset($newc);

/*now we need to write down data and close files*/
$fd1 = fopen("smsData/toSend.pdr", "w");
$fd2 = fopen("smsData/sent.pdr", "w");

$t = 0;
if (count($b) > 0) {
    fwrite($fd1, "not empty" . PHP_EOL);
    foreach ($b as $key => $value) {
        $t++;
        if ($t == count($b))
            fwrite($fd1, $key . ' ' . $value);
        else
            fwrite($fd1, $key . ' ' . $value . PHP_EOL);
    }
} else {
    fwrite($fd1, 'empty');
}
fclose($fd1);

$t = 0;
if (count($c) > 0) {
    fwrite($fd2, "not empty" . PHP_EOL);
    foreach ($c as $key => $value) {
        $t++;
        if ($t == count($c))
            fwrite($fd2, $key . ' ' . $value);
        else
            fwrite($fd2, $key . ' ' . $value . PHP_EOL);
    }
} else {
    fwrite($fd2, 'empty');
}
fclose($fd2);
echo 'Everything\'s OKAY';
/*
// Use the client to do fun stuff like send text messages!
$client->messages->create(
// the number you'd like to send the message to
    '+15558675309',
    array(
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+15017250604',
        // the body of the text message you'd like to send
        'body' => "Hey Jenny! Good luck on the bar exam!"
    )
);
*/

function readArr($fd)
{
    $str = htmlentities(fgets($fd));
    if ($str == 'empty') {
        return array();
    }
    $names = array();
    $dates = array();
    while (!feof($fd)) {
        $str = htmlentities(fgets($fd));
        $pieces = explode(" ", $str);
        // [0] -- номер
        // [1] -- время
        array_push($names, $pieces[0]);
        array_push($dates, (int)htmlspecialchars_decode(str_replace(PHP_EOL, "", $pieces[1])));
    }
    $ret = array_combine($names, $dates);
    return $ret;
}

