<?php

session_start();

try {
    require(__DIR__."/../../db/connection.php");

    
    $stmt = $conn->prepare("DELETE FROM Products WHERE id=:productId");
    $stmt->bindParam(":productId", $productId);
    
    $productId = $_SESSION["product-delete"];
    $stmt->execute();

    header("Location: http://localhost:80/products");
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>