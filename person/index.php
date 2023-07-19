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
            <?php

            if (!isset($_GET["PEdit"]) && !isset($_GET["PDelete"])) {
                require "/xampp/htdocs/person/add/form.php";
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