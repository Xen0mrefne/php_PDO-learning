<?php

    function getAllProducts() {
        require(__DIR__."/tableCheck.php");

        try {
            require(__DIR__."/../db/connection.php");

            $stmt = $conn->prepare(
                "SELECT Products.*,
                Users.firstName AS publisherFirstName,
                Users.lastName AS publisherLastName
                FROM Products INNER JOIN Users
                ON Products.publishedBy=Users.id"
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
                WHERE Products.id=:productId"
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

?>