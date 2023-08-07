<?php

try {
    require(__DIR__."/../db/connection.php");

    $sql = "CREATE TABLE IF NOT EXISTS Products(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        productName VARCHAR(30) NOT NULL,
        productDesc VARCHAR(255) NOT NULL,
        productPrice FLOAT(6,2) UNSIGNED NOT NULL,
        productStock INT(6) UNSIGNED NOT NULL,
        publishedBy INT(6) UNSIGNED,
        FOREIGN KEY (publishedBy) REFERENCES Users(id) ON DELETE CASCADE,
        updatedDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $conn->exec($sql);

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>