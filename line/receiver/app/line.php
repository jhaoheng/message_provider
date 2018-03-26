<?php  


/**
* 
*/
class LINE
{
  function __construct(){
    
  }

  public function Signature_validation($Channel_secret, $X_Line_Signature, $data){
    $r = hash_hmac("sha256", $data, $Channel_secret, true);

    $verify = base64_decode($X_Line_Signature);

    if ($r == $verify) {
      return true;
    }
    else{
      return false;
    }
  }

  public function Parse_body($body){
    
    $receive = json_decode($body_str, true);

    // event type
    $eventType = $receive["events"]["type"];

    // replyToken
    $replyToken = $receive["events"]["replyToken"];

    // source from  [user, group, room]
    $msgType = $receive["events"]["source"]["type"];
    if ($msgType == "room") {
      $from = $receive["events"]["source"]["roomId"];
    }else if ($msgType == "group") {
      $from = $receive["events"]["source"]["groupId"];
    }else{
      $from = $receive["events"]["source"]["userId"];
    }

    // message
    $msgType = $receive["events"]["message"]["type"];
    $msgId = $receive["events"]["message"]["id"];
    $msgText = $receive["events"]["message"]["text"];
  }

  public function send($access_token, $msgbodystr){
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
    curl_setopt( $ch,CURLOPT_POSTFIELDS, $msgbodystr );
    $r_body = curl_exec($ch);
    $r_info = curl_getinfo($ch);

    curl_close( $ch );

    $http_code = $r_info["http_code"];
    return [
      "http_code" => $http_code,
      "ret" => $r_body
    ];
  }
}

?>