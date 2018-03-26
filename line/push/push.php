<?php  

function send($access_token, $body){


  $headers = array
  (
      'Authorization: Bearer ' . $access_token,
      'Content-Type: application/json'
  );
  $ch = curl_init();
  curl_setopt( $ch,CURLOPT_URL, 'https://api.line.me/v2/bot/message/push' );
  curl_setopt( $ch,CURLOPT_POST, true );
  curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
  curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
  curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $body ) );
  $body = curl_exec($ch);
  $info = curl_getinfo($ch);

  $result = handle_response($info, $body);
  curl_close( $ch );
  return $result;
}

function handle_response($info, $body){
  $http_code = $info["http_code"];
  return [
    "http_code" => $http_code,
    "ret" => $body
  ];
}

$file = __DIR__."/config.json";
$data = file_get_contents($file);
$jsonstr = json_decode($data, true);
$Channel_Access_Token = $jsonstr["Channel_Access_Token"];
$body = $jsonstr["body"];

$r = send($Channel_Access_Token, $body);
var_dump($r);

?>