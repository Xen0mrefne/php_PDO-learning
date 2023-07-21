<?php

try {
    require "/xampp/htdocs/db/connection.php";

    $user_id = $_GET["PEdit"];


    $stmt = $conn->prepare("SELECT * FROM Users WHERE id = $user_id");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user = $stmt->fetch();

    $_SESSION["user-edit"] = $user_id;

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<form action="http://localhost/users/edit/action.php" method="post">
    <div class="form-input">
        <label for="firstName">First Name:</label>
        <input class="input" id="firstName" name="firstName" type="text" placeholder="First name"
        value="<?php echo $user["firstName"] ?>">
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
        value="<?php echo $user["lastName"] ?>">
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
        value="<?php echo $user["email"] ?>">
        <?php
            if (isset($_SESSION["errors"]["email"])) {
                ?>
                    <p style="color: red; font-size: 12px"><?php echo $_SESSION["errors"]["email"] ?></p>
                <?php
            }
        ?>
    </div>
    <button class="btn btn-blue btn-fill" type="submit">Edit</button>
    <a class="btn btn-black btn-hover" style="text-align: center;" href="http://localhost:80/users">Cancel</a>
</form>