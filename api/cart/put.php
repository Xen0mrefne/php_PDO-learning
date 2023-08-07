<?php

header('Content-Type: application/json; charset=utf-8');

$body = json_decode(file_get_contents("php://input"));

session_start();

if (isset($_SESSION["currentUser"])) {

    $response = array();

    if (!isset($body->productId) || !isset($body->action)) {
        http_response_code(400);
        $response["message"] = "Request error";
        echo json_encode($response);
        die();
    }
    
    require(__DIR__."/../../products/cart/tableCheck.php");
    
    try {
        require(__DIR__."/../../db/connection.php");
        require(__DIR__."/../../utils/security.php");
        
        $stmt = $conn->prepare(
            "SELECT amount FROM Cart WHERE userId=:userId AND productId=:productId"
        );
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":productId", $productId);
        
        $userId = $_SESSION["currentUser"]["id"];
        $productId = $body->productId;
        
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        $result = $stmt->fetch();
        
        if (empty($result)) {
            http_response_code(400);
            $response["message"] = "Request error";
            echo $response;
            die();
        }
        
        $amount = $result["amount"];
        
        $action = $body->action;

        if ($action === "substract") {
            if ($amount < 2) {
                echo json_encode(array(
                    "message"=>"Can't substract anymore"
                ));
                die();
            } else {
                $amount -= 1;
            }
        }
        if ($action === "add") {
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

        http_response_code(200);
        $response["message"] = "Product added to cart successfully";
        $response["amount"] = $amount;
        echo json_encode(array(
            "message"=>"Product added to cart.",
            "amount"=>$amount
        ));
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    die();
}


?>