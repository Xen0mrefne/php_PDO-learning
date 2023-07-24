<?php

session_start();

if (isset($_SESSION["currentUser"])) {
    if (!isset($_GET["productId"])) {
        header("Location: http://localhost:80/products");
        die();
    }

    require("/xampp/htdocs/products/cart/tableCheck.php");

    try {
        require("/xampp/htdocs/db/connection.php");
        require("/xampp/htdocs/utils/security.php");

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