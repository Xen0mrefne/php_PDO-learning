<?php

function getCart() {
    require("/xampp/htdocs/products/cart/tableCheck.php");

    try {
        require("/xampp/htdocs/db/connection.php");

        $stmt = $conn->prepare(
            "SELECT
                Cart.amount,
                Products.id,
                Products.productName,
                Products.productDesc,
                Products.updatedDate
             FROM Cart
            LEFT JOIN Products ON 
            Cart.productId = Products.id
            WHERE userId=:userId"
        );
        $stmt->bindParam(':userId', $userId);

        $userId = $_SESSION["currentUser"]["id"];

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $results = $stmt->fetchAll();

        $cart = array();
        
        foreach($results as $product) {
            array_push($cart, new ProductInCart(
                $userId,
                new Product(
                    $product["id"],
                    $product["productName"],
                    $product["productDesc"],
                    $product["updatedDate"]
                ),
                $product["amount"]
            ));
        }
        
        $conn = null;
        
        return $cart;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>