<?php

try {
    require "/xampp/htdocs/db/connection.php";


    $person_id = $_GET["PDelete"];


    $stmt = $conn->prepare("SELECT * FROM Person WHERE id = $person_id");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $person = $stmt->fetch();

    $_SESSION["person-delete"] = $person_id;

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<div class="delete-confirm">
    <p>Are you sure you want to delete person <?php
    echo $person["firstName"]." ".$person["lastName"]
    ?>?</p>
    <a class="btn btn-black btn-hover" href="http://localhost/person">Cancel</a>
    <a class="btn btn-red btn-fill" href="http://localhost/person/delete/action.php">Delete</a>
</div>