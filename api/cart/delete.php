<?php

header('Content-Type: application/json; charset=utf-8');

session_start();

if (isset($_SESSION["currentUser"])) {
    $response = array();
    if (!isset($_GET["product"])) {
        http_response_code(400);
        $response["error"] = "Bad request";
        echo json_encode($response);
        die();
    }

    require(__DIR__."/../../products/cart/tableCheck.php");

    try {
        require(__DIR__."/../../db/connection.php");
        require(__DIR__."/../../utils/security.php");


        $stmt = $conn->prepare(
            "DELETE FROM Cart WHERE userId=:userId AND productId=:productId"
        );
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":productId", $productId);

        $userId = $_SESSION["currentUser"]["id"];
        $productId = sanitize($_GET["product"]);

        $stmt->execute();


        $conn = null;

        http_response_code(200);
        $response["message"] = "Product has been removed from cart.";
        echo json_encode($response);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    http_response_code(401);
    die();
}

?>