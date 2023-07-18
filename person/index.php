<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/general.css">
</head>
<body>
    <main>
        <section class="persons">
            <form action="../person/add.php" method="post">
                <div class="form-input">
                    <label for="firstName">First Name:</label>
                    <input class="input" id="firstName" name="firstName" type="text" placeholder="First name">
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
                    <input class="input" id="lastName" name="lastName" type="text" placeholder="Last name">
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
                    <input class="input" id="email" name="email" type="text" placeholder="Email">
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

            <?php

            if (!isset($_GET["PEdit"]) && !isset($_GET["PDelete"])) {
                require "/xampp/htdocs/person/get.php";
            } else {
                if (isset($_GET["PEdit"])) {
                    require "/xampp/htdocs/person/edit/form.php";
                }
                if (isset($_GET["PDelete"])) {
                    require "/xampp/htdocs/person/delete/confirmation.php";
                }
            }

            ?>
        </section>
    </main>
</body>
</html>