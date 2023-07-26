<?php

require(__DIR__."/credentials.php");

$conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>