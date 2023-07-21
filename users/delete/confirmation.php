<?php

try {
    require "/xampp/htdocs/db/connection.php";


    $user_id = $_GET["PDelete"];


    $stmt = $conn->prepare("SELECT * FROM Users WHERE id = $user_id");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user = $stmt->fetch();

    $_SESSION["user-delete"] = $user_id;

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<div class="delete-confirm">
    <p>Are you sure you want to delete user <?php
    echo $user["firstName"]." ".$user["lastName"]
    ?>?</p>
    <a class="btn btn-black btn-hover" href="http://localhost/users">Cancel</a>
    <a class="btn btn-red btn-fill" href="http://localhost/users/delete/action.php">Delete</a>
</div>