<?php

session_start();

try {
    require "/xampp/htdocs/db/connection.php";

    $person_id = $_SESSION["person-delete"];

    $stmt = $conn->prepare("DELETE FROM Person WHERE id=$person_id");
    $stmt->execute();

    header("Location: http://localhost:80/person");
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>