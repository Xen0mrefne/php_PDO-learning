<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/users.css">
</head>
<body>
    <header>
        <a href="http://localhost:80/products" class="btn btn-black btn-fill">Go to products</a>
    </header>
    <main>
        <section class="users">
            <?php

            if (!isset($_GET["PEdit"]) && !isset($_GET["PDelete"])) {
                require(__DIR__."/add/form.php");
                require(__DIR__."/get.php");

                $users = getUsers();

                if (!empty($users)){
                    ?>
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Email</th>
                                    <th>Register date</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require(__DIR__."/../entity/user.php");
                                    foreach($users as $u) {
                                        $user = new User(
                                            $u["id"],
                                            $u["firstName"],
                                            $u["lastName"],
                                            $u["email"],
                                            $u["reg_date"]
                                        )
                                        ?>
                                            <tr>
                                                <td><?php echo $user->getId(); ?></td>
                                                <td><?php echo $user->getFirstName() ?></td>
                                                <td><?php echo $user->getLastName() ?></td>
                                                <td><?php echo $user->getEmail() ?></td>
                                                <td><?php echo $user->getRegDate() ?></td>
                                                <td class="action-col"><a href="?PEdit=<?php echo $user->getId() ?>" class="btn btn-blue btn-hover">Edit</a></td>
                                                <td class="action-col"><a href="?PDelete=<?php echo $user->getId() ?>" class="btn btn-red btn-hover">Delete</a></td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    <?php
                } else {
                    ?>
                        <p style="text-align: center">No users found. You can try to add some!</p>
                    <?php
                }
            } else {
                if (isset($_GET["PEdit"])) {
                    require(__DIR__."/edit/form.php");
                }
                if (isset($_GET["PDelete"])) {
                    require(__DIR__."/delete/confirmation.php");
                }
            }

            ?>
        </section>
    </main>
</body>
</html>