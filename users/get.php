<?php

require "/xampp/htdocs/users/tableCheck.php";

function getUsers() {
    try {
        require "/xampp/htdocs/db/connection.php";
    
        $stmt = $conn->prepare("SELECT * FROM Users");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
        $users = $stmt->fetchAll();
        $conn = null;

        return $users;
    
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>