<?php  

include_once "line.php";

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

$Channel_secret = ""; // need set from line developer console


//


$headers = getallheaders();
$headers_str = json_encode($headers);
$body_str = file_get_contents("php://input");

$LINE = new Line;
$X_Line_Signature = $headers["X-Line-Signature"];
$is_line_sender = $LINE->Signature_validation($Channel_secret, $X_Line_Signature, $body_str);
if (!$is_line_sender) {
/*
 Should return the status code 200 for a HTTP POST request sent by a webhook.
 HTTP POST requests sent by a webhook are not resent if the request fails.
 */
  http_response_code(404);
}


$file = 'log.txt';
$save = file_get_contents($file);
$save .= "====================\n";
$save .= "[header]\n";
$save .= "$headers_str\n\n";
$save .= "[body]\n";
$save .= "$body_str\n";
$save .= "====================\n";
file_put_contents($file, $save);

/*
 Should return the status code 200 for a HTTP POST request sent by a webhook.
 HTTP POST requests sent by a webhook are not resent if the request fails.
 */
http_response_code(200);
?>