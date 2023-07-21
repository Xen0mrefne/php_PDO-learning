<?php

session_start();

try {
    require "/xampp/htdocs/db/connection.php";

    $user_id = $_SESSION["user-delete"];

    $stmt = $conn->prepare("DELETE FROM Users WHERE id=$user_id");
    $stmt->execute();

    header("Location: http://localhost:80/users");
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>