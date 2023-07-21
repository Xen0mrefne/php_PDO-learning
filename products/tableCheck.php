<?php

try {
    require "/xampp/htdocs/db/connection.php";

    $sql = "CREATE TABLE IF NOT EXISTS Products(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        description VARCHAR(30) NOT NULL,
        updated_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $conn->exec($sql);

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>