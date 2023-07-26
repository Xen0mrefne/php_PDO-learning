<?php

session_start();

if (isset($_SESSION["currentUser"])) {
    if (!isset($_GET["ProductId"])) {
        header("Location: http://localhost:80/products");
        die();
    }
    $_SESSION["editingCart"] = true;

    require(__DIR__."/tableCheck.php");

    try {
        require(__DIR__."/../../db/connection.php");
        require(__DIR__."/../../utils/security.php");


        $stmt = $conn->prepare(
            "DELETE FROM Cart WHERE userId=:userId AND productId=:productId"
        );
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":productId", $productId);

        $userId = $_SESSION["currentUser"]["id"];
        $productId = sanitize($_GET["ProductId"]);

        $stmt->execute();


        $conn = null;

        header("Location: http://localhost:80/products");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    header("Location: http://localhost:80/products");
    die();
}

?>