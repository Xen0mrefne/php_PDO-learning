<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();
    
    require(__DIR__."/../tableCheck.php");
    require(__DIR__."/../../utils/security.php");

    if (isset($_SESSION["currentUser"])) {

        try {
    
            $errors = array();
    
            if (empty($_POST["productName"])) {
                $errors["productName"] = "Product name is required";
            } else {
                $productName = sanitize($_POST["productName"]);
            }
    
            if (empty($_POST["productDesc"])) {
                $errors["productDesc"] = "Product description is required";
            } else {
                $productDesc = sanitize($_POST["productDesc"]);
            }

            if (empty($_POST["productPrice"])) {
                $errors["productPrice"] = "Price is required";
            } else {
                $productPrice = sanitize($_POST["productPrice"]);
                if (!is_numeric($productPrice)) {
                    $errors["productPrice"] = "Price must only contain a number";
                } else {
                    if ($productPrice < 1) {
                        $errors["productPrice"] = "Price must be higher than zero";
                    }
                }
            }
    
            if (empty($errors)) {
                require(__DIR__."/../../db/connection.php");
    
                $stmt = $conn->prepare(
                    "INSERT INTO Products (productName, productDesc, productPrice, publishedBy)
                    VALUES (:productName, :productDesc, :productPrice, :publishedBy)"
                );
    
                $stmt->bindParam(":productName", $productName);
                $stmt->bindParam(":productDesc", $productDesc);
                $stmt->bindParam(":productPrice", $productPrice);
                $stmt->bindParam(":publishedBy", $publishedBy);

                $publishedBy = $_SESSION["currentUser"]["id"];

                $stmt->execute();
            } else {
                $_SESSION["errors"] = $errors;
            }
    
            header("Location: http://localhost:80/products");
    
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        header("Location: http://localhost:80/products");
        die();
    }

}

?>