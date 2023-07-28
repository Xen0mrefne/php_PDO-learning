<?php

    function getAllProducts() {
        require(__DIR__."/tableCheck.php");

        try {
            require(__DIR__."/../db/connection.php");

            $stmt = $conn->prepare(
                "SELECT * FROM Products"
            );
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $products = $stmt->fetchAll();
            $conn = null;

            return $products;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function getProduct($productId) {
        require(__DIR__."/tableCheck.php");

        try {
            require(__DIR__."/../db/connection.php");

            $stmt = $conn->prepare(
                "SELECT *
                FROM Products
                WHERE id=:productId"
            );
            $stmt->bindParam(":productId", $productId);

            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $product = $stmt->fetch();
            $conn = null;

            return $product;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function getPublisher($userId) {
        require(__DIR__."/tableCheck.php");

        try {
            require(__DIR__."/../db/connection.php");

            $stmt = $conn->prepare(
                "SELECT firstName, lastName
                FROM Users
                WHERE id=:userId"
            );
            $stmt->bindParam(":userId", $userId);

            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $user = $stmt->fetch();
            $conn = null;

            return $user;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

?>