<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require __DIR__."/../tableCheck.php";
    require __DIR__."/../../utils/security.php";

    session_start();

    try {

        require __DIR__."/../../db/connection.php";

        $_SESSION["errors"] = array();

        
        
        $userId = $_SESSION["user-edit"];

        if (empty($_POST["firstName"])) {
            $_SESSION["errors"]["firstName"] = "First name is required";
        } else {
            $firstName = sanitize($_POST["firstName"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
                $_SESSION["errors"]["firstName"] = "First name must contain only letters and spaces.";
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
            $stmt = $conn->prepare("UPDATE Users SET
            firstName=:firstName,
            lastName=:lastName,
            email=:email
            WHERE id=:userId");

            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            header("Location: http://localhost:80/users");
        } else {
            header("Location: http://localhost:80/users/?UEdit=$userId");
        }

        die();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>