<?php

    function getProducts() {
        require("/xampp/htdocs/products/tableCheck.php");

        try {
            require("/xampp/htdocs/db/connection.php");

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