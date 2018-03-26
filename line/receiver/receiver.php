<?php  


$headers = getallheaders();
var_dump($headers);

$body = file_get_contents("php://input");
var_dump($body);


// $receive = json_decode(file_get_contents("php://input"));

?>