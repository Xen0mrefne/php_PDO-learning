<?php

    function getProducts() {
        require(__DIR__."/tableCheck.php");

        try {
            require(__DIR__."/../db/connection.php");

            $stmt = $conn->prepare("SELECT * FROM Products");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $products = $stmt->fetchAll();
            $conn = null;

            return $products;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

?>