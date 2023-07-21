<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select user</title>

    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/products.css">
</head>
<body>
    <div class="user-select-wrapper">
            <?php
                
                require "/xampp/htdocs/users/get.php";

                $users = getUsers();

                if (!empty($users)) {
                    ?>
                        <form action="http://localhost:80/products/users/select/action.php" method="post">
                            <select name="user" id="user">
                                <?php
                                    if (!isset($_SESSION["currentUser"])) {
                                        ?>
                                            <option value="" disabled selected></option>
                                        <?php
                                    }
                                    require "/xampp/htdocs/entity/user.php";
                                    foreach($users as $u) {
                                        $user = new User(
                                            $u["id"],
                                            $u["firstName"],
                                            $u["lastName"],
                                            $u["email"],
                                            $u["regDate"]
                                        );

                                        ?>
                                            <option
                                            value="<?php echo $user->getId() ?>"
                                            <?php
                                                if (isset($_SESSION["currentUser"])) {
                                                    if ($user->getId() === $_SESSION["currentUser"]["id"]) {
                                                        echo "selected";
                                                    }
                                                }
                                            ?>
                                            >
                                                <?php echo $user->getFirstName()." ".$user->getLastName() ?>
                                            </option>
                                        <?php
                                    }
                                ?>
                            </select>
                            <div class="options">
                                <a class="btn btn-black btn-hover text-center" href="http://localhost:80/products">Cancel</a>
                                <button class="btn btn-blue btn-fill" type="submit">Ok</button>
                            </div>
                        </form>
                    <?php
                }  
            ?>
    </div>
</body>
</html>