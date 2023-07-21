<?php

session_start();

if (isset($_SESSION["currentUser"])){
    require "/xampp/htdocs/users/user.php";
    $user = new User(
        $_SESSION["currentUser"]["id"],
        $_SESSION["currentUser"]["firstName"],
        $_SESSION["currentUser"]["lastName"],
        $_SESSION["currentUser"]["email"],
    );
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/products.css">
</head>
<body>
    <header>
        <nav>
            <a href="http://localhost:80/users" class="btn btn-black btn-hover">Manage users</a>
            <div class="user">
                <span>
                    <?php
                        if (isset($user)) {
                            echo "User: ".$user->getFirstName()." ".$user->getLastName();
                        } else {
                            echo "User: Not selected";
                        }
                    ?> 
                </span>
                <a href="http://localhost:80/products/users" class="btn btn-blue btn-hover">Select user</a>
            </div>
        </nav>
    </header>
    <main>
        <section class="products">
            <div class="add">
                
            </div>
        </section>
    </main>
</body>
</html>