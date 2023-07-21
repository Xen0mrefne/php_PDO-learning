<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "/xampp/htdocs/products/tableCheck.php";
    require "/xampp/htdocs/utils/security.php";
    require "/xampp/htdocs/users/user.php";

    session_start();

    try {
        
        require "/xampp/htdocs/db/connection.php";

        $stmt = $conn->prepare("SELECT id, firstName, lastName, email FROM Users WHERE id=:user_id");
        $stmt->bindParam(":user_id", $user_id);

        $user_id = sanitize($_POST["user"]);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $user = $stmt->fetch();

        $_SESSION["currentUser"] = $user;

        $conn = null;

        header("Location: http://localhost:80/products");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>