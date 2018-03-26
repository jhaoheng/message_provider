<?php  

if (!function_exists('getallheaders')) 
{ 
    function getallheaders() 
    { 
           $headers = []; 
       foreach ($_SERVER as $name => $value) 
       { 
           if (substr($name, 0, 5) == 'HTTP_') 
           { 
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value; 
           } 
       } 
       return $headers; 
    } 
} 

function Signature_validation(){

}

function Parse_body(){
  // 將收到的資料整理至變數
  $receive = json_decode(file_get_contents("php://input"));
  // 讀取收到的訊息內容
  $text = $receive->events[0]->message->text;
  // 讀取訊息來源的類型  [user, group, room]
  $type = $receive->events[0]->source->type;
  // 由於新版的Messaging Api可以讓Bot帳號加入多人聊天和群組當中
  // 所以在這裡先判斷訊息的來源
  if ($type == "room") {
    // 多人聊天 讀取房間id
    $from = $receive->events[0]->source->roomId;
  } 
  else if ($type == "group") {
    // 群組 讀取群組id
    $from = $receive->events[0]->source->groupId;
  }
  else {
    // 一對一聊天 讀取使用者id
    $from = $receive->events[0]->source->userId;
  }
}

$headers = getallheaders();
$headers_str = json_encode($headers);

$body = file_get_contents("php://input");
$body_str = json_encode($body);

$file = 'log.txt';
$save = file_get_contents($file);
$save .= "====================\n";
$save .= "[header]\n";
$save .= "$headers_str\n\n";
$save .= "[body]\n";
$save .= "$body_str\n";
$save .= "====================\n";
file_put_contents($file, $save);



// /*
// Should return the status code 200 for a HTTP POST request sent by a webhook.
// HTTP POST requests sent by a webhook are not resent if the request fails.
//  */
http_response_code(200);
?>