<?php  

/**
 * [sendInBackground description]
 * @param  [array] $registrationIds [firebase 的 push_token]
 *            - 格式 ['token_1', 'token_2']
 * @return [type]                  [description]
 */
function send($key, $registrationIds, $title, $body, $badge=0, $sound=1, $vibrate=1, $others=""){

    if (count($registrationIds)==0) {
        return false;
    }

    $msg = array
    (
        'title'     => $title,
        'body'      => $body,
        'badge'     => $badge,
        'others'    => "",
        'sound'     => $sound,
        'vibrate'   => $vibrate
    );
    $fields = array
    (
        'registration_ids'  => $registrationIds,
        'notification'      => $msg,
        'priority'          => 10, //貌似是優先權,iOS不加會收不到推播,Android可不加
    );
     
    $headers = array
    (
        'Authorization: key=' . $key,
        'Content-Type: application/json'
    );
     
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    $result = curl_exec($ch );
    curl_close( $ch );

    return $result;
} 

/**
 * [deleteFailToken description]
 * @param  [type] $registrationIds [所有要推送的 push token]
 * @param  [type] $resultOfSender  [推送過後 firebase 的 result]
 * @return [type]                  [description]
 */
/*
Success example: {"message_id": "1023456"}
failure example: {"error": "TopicsMessageRateExceeded"}
*/
function deleteFailToken($registrationIds, $resultOfSender){
    $r = json_decode($resultOfSender, true);
    $return = $r['results'];
    $inValid_tokens = [];
    foreach ($return as $key => $value) {
        if (array_key_exists('error', $value)) {
            $inValid_tokens[count($inValid_tokens)] = $registrationIds[$key];
        }
    }
    return $inValid_tokens;
}

$file = __DIR__."/config.json";
$data = file_get_contents($file);
$json = json_decode($data, true);

$CloudMessage_ServerKey = $json["CloudMessage_ServerKey"];
$registrationIds = $json["registrationIds"];

$message = $json["message"];
$title = $message['title'];
$body = $message['body'];
$badge = $message['badge'];


echo PHP_EOL;
echo "*** Result ***".PHP_EOL;
$r = send($CloudMessage_ServerKey, $registrationIds, $title, $body, $badge);
var_dump($r);

echo PHP_EOL;
echo "*** Invalid Tokens ***".PHP_EOL;
$r = deleteFailToken($registrationIds, $r);
var_dump($r);


?>