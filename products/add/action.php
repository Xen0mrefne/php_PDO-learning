<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require(__DIR__."/../tableCheck.php");
    require(__DIR__."/../../utils/security.php");

    session_start();
    
    try {

        $_SESSION["errors"] = array();

        if (empty($_POST["productName"])) {
            $_SESSION["errors"]["productName"] = "Product name is required";
        } else {
            $productName = sanitize($_POST["productName"]);
        }

        if (empty($_POST["productDesc"])) {
            $_SESSION["errors"]["productDesc"] = "Product description is required";
        } else {
            $productDesc = sanitize($_POST["productDesc"]);
        }

        if (empty($_SESSION["errors"])) {
            require(__DIR__."/../../db/connection.php");

            $stmt = $conn->prepare(
                "INSERT INTO Products (productName, productDesc)
                VALUES (:productName, :productDesc)"
            );

            $stmt->bindParam(":productName", $productName);
            $stmt->bindParam(":productDesc", $productDesc);
            $stmt->execute();
        }

        header("Location: http://localhost:80/products");

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

?>