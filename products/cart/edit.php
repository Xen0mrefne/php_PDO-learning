<?php

session_start();

if (isset($_SESSION["currentUser"])) {
    if (!isset($_GET["ProductId"]) || !isset($_GET["change"])) {
        header("Location: http://localhost:80/products");
        die();
    }
    $_SESSION["editingCart"] = true;

    require(__DIR__."/tableCheck.php");

    try {
        require(__DIR__."/../../db/connection.php");
        require(__DIR__."/../../utils/security.php");

        $stmt = $conn->prepare(
            "SELECT amount FROM Cart WHERE userId=:userId AND productId=:productId"
        );
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":productId", $productId);

        $userId = $_SESSION["currentUser"]["id"];
        $productId = sanitize($_GET["ProductId"]);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $result = $stmt->fetch();

        if (empty($result)) {
            header("Location: http://localhost:80/products");
            die();
        }

        $amount = $result["amount"];

        $change = sanitize($_GET["change"]);

        if ($change === "substract") {
            if ($amount < 2) {
                header("Location: http://localhost:80/products");
                die();
            } else {
                $amount -= 1;
            }

        }
        if ($change === "add") {
            $amount += 1;
        }

        $stmt = $conn->prepare(
            "UPDATE Cart SET amount=:amount WHERE userId=:userId AND productId=:productId"
        );
        $stmt->bindParam(":amount", $amount);
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":productId", $productId);

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