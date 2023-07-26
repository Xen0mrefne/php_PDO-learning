<?php

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        require(__DIR__."/get.php");
        break;
    case "PUT":
        require(__DIR__."/put.php");
        break;
}

?>