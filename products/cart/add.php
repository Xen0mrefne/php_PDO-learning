<?php

session_start();

if (isset($_SESSION["currentUser"])) {
    if (!isset($_GET["productId"])) {
        header("Location: http://localhost:80/products");
        die();
    }

    require(__DIR__."/tableCheck.php");

    try {
        require(__DIR__."/../../db/connection.php");
        require(__DIR__."/../../utils/security.php");

        /* Check if product is already in cart */

        $stmt = $conn->prepare(
            "SELECT productId FROM Cart WHERE userId=:userId AND productId=:productId"
        );

        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":productId", $productId);

        $userId = $_SESSION["currentUser"]["id"];
        $productId = sanitize($_GET["productId"]);
        
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        /* Return to products page if product is already in cart */
        
        if (!empty($stmt->fetch())) {
            header("Location: http://localhost:80/products");
            die();
        }
        
        /* Add product in cart */

        $stmt = $conn->prepare(
            "INSERT INTO Cart (userId, productId, amount)
            VALUES (:userId, :productId, :amount)"
        );
        
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":productId", $productId);
        $stmt->bindParam(":amount", $amount);
        
        $userId = $_SESSION["currentUser"]["id"];
        $productId = sanitize($_GET["productId"]);
        $amount = 1;

        $stmt->execute();

        $conn = null;

        header("Location: http://localhost:80/products");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>