<?php

$body = file_get_contents("php://input");

header('Content-Type: application/json; charset=utf-8');

echo $body

?>