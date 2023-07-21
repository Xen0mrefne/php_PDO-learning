<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require "/xampp/htdocs/users/tableCheck.php";
    require "/xampp/htdocs/utils/security.php";
    
    session_start();
    
    try {
        
        require "/xampp/htdocs/db/connection.php";

        $_SESSION["errors"] = array();
    
        $stmt = $conn->prepare("INSERT INTO Users (firstName, lastName, email)
        VALUES (:firstName, :lastName, :email)");
    
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
    

        if (empty($_POST["firstName"])) {
            $_SESSION["errors"]["firstName"] = "First name is required";
        } else {
            $firstName = sanitize($_POST["firstName"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
                $_SESSION["errors"]["firstName"] = "First name must only contain letters and spaces.";
            }
        }

        if (empty($_POST["lastName"])) {
            $_SESSION["errors"]["lastName"] = "Last name is required";
        } else {
            $lastName = sanitize($_POST["lastName"]);
        }

        if (empty($_POST["email"])) {
            $email = NULL;
        } else {
            $email = sanitize($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION["errors"]["email"] = "Invalid email format";
            }
        }

        if (empty($_SESSION["errors"])) {
            $stmt->execute();
        }

        header("Location: http://localhost:80");
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    
    $conn = null;
} else {
    header("Location: http://localhost:80");
}


?>