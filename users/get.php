<?php


function getUsers() {
    require(__DIR__."/tableCheck.php");
    try {
        require(__DIR__."/../db/connection.php");
    
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