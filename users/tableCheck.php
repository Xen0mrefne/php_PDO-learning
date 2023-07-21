<?php

try {
    require "/xampp/htdocs/db/connection.php";

    $sql = "CREATE TABLE IF NOT EXISTS Users(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstName VARCHAR(30) NOT NULL,
        lastName VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $conn->exec($sql);

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>