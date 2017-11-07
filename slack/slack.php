<?php

function slackBot($slackUrl, $slackChannel, $slackBotName, $slackBotIcon, $message){

    if (empty($message)) {
        $message = "no get message";
    }

    $systime = new SYSTime;
    $date = $systime->getNowDate();


    $payload = array(
        "channel" => $slackChannel,
        "username" => $date." ".$slackBotName,
        "text" => $message,
        "icon_emoji" => $slackBotIcon
    );

    $data = "payload=".json_encode($payload);


    $ch = curl_init();
    // Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL,$slackUrl);
    curl_setopt($ch, CURLOPT_POST, 1); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
    // Execute
    $result=curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // echo $result." => ". $httpcode.PHP_EOL;
} 

$slackUrl       = getenv('slackUrl');
$slackChannel   = getenv('slackChannel');
$slackBotName   = getenv('slackBotName');
$slackBotIcon   = getenv('slackBotIcon');

$data = json_decode(file_get_contents('php://input'), true);
$message = $data['message'];

function slackBot($slackUrl, $slackChannel, $slackBotName, $slackBotIcon, $message);

?>