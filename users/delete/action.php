<?php

session_start();

try {
    require(__DIR__."/../../db/connection.php");

    
    $stmt = $conn->prepare("DELETE FROM Users WHERE id=:userId");
    $stmt->bindParam(":userId", $userId);
    
    $userId = $_SESSION["user-delete"];
    $stmt->execute();

    header("Location: http://localhost:80/users");
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>