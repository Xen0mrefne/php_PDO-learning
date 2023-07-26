<?php

try {
    require(__DIR__."/../../db/connection.php");

    $sql = "CREATE TABLE IF NOT EXISTS Cart(
        userId INT(6) UNSIGNED NOT NULL,
        productId INT(6) UNSIGNED NOT NULL,
        amount INT(6) UNSIGNED NOT NULL,
        FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (productId) REFERENCES products(id) ON DELETE CASCADE
    )";
    
    $conn->exec($sql);

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>