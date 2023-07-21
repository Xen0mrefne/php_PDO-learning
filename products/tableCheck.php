<?php

try {
    require "/xampp/htdocs/db/connection.php";

    $sql = "CREATE TABLE IF NOT EXISTS Products(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        productName VARCHAR(30) NOT NULL,
        productDesc VARCHAR(255) NOT NULL,
        updatedDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $conn->exec($sql);

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>