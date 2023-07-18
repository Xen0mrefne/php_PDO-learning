<?php


try {
    require "/xampp/htdocs/db/connection.php";

    $person_id = $_GET["PEdit"];


    $stmt = $conn->prepare("SELECT * FROM Person WHERE id = $person_id");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $person = $stmt->fetch();

    $_SESSION["person-edit"] = $person_id;

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<form action="http://localhost/person/edit/action.php" method="post">
    <div class="form-input">
        <label for="firstName">First Name:</label>
        <input class="input" id="firstName" name="firstName" type="text" placeholder="First name"
        value="<?php echo $person["firstName"] ?>">
        <?php
            if (isset($_SESSION["errors"]["firstName"])) {
                ?>
                    <p style="color: red; font-size: 12px"><?php echo $_SESSION["errors"]["firstName"] ?></p>
                <?php
            }
        ?>
    </div>
    <div class="form-input">
        <label for="lastName">Last Name:</label>
        <input class="input" id="lastName" name="lastName" type="text" placeholder="Last name"
        value="<?php echo $person["lastName"] ?>">
        <?php
            if (isset($_SESSION["errors"]["lastName"])) {
                ?>
                    <p style="color: red; font-size: 12px"><?php echo $_SESSION["errors"]["lastName"] ?></p>
                <?php
            }
        ?>
    </div>
    <div class="form-input">
        <label for="email">Email:</label>
        <input class="input" id="email" name="email" type="text" placeholder="Email"
        value="<?php echo $person["email"] ?>">
        <?php
            if (isset($_SESSION["errors"]["email"])) {
                ?>
                    <p style="color: red; font-size: 12px"><?php echo $_SESSION["errors"]["email"] ?></p>
                <?php
            }
        ?>
    </div>
    <button class="btn btn-green btn-fill" type="submit">Submit</button>
</form>