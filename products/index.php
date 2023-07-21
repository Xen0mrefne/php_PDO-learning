<?php

session_start();

if (isset($_SESSION["currentUser"])){
    require "/xampp/htdocs/entity/user.php";
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
        <?php
            if (isset($_SESSION["currentUser"])) {
                require("/xampp/htdocs/products/add/form.php");
            }
        ?>
        <section class="products">
            <?php

                require("/xampp/htdocs/products/get.php");

                $products = getProducts();

                if (!empty($products)) {

                    require("/xampp/htdocs/entity/product.php");
                    ?>
                        <ul class="product-list">
                            <?php
                            foreach($products as $p) {
                                $product = new Product(
                                    $p["id"],
                                    $p["productName"],
                                    $p["productDesc"],
                                    $p["updatedDate"]
                                );

                                ?>
                                    <li class="product">
                                        <h3><?php echo $product->getProductName() ?></h3>
                                        <p class="description"><?php echo $product->getProductDesc() ?></p>
                                        <button class="btn btn-blue btn-hover">Add to cart</button>
                                    </li>
                                <?php
                            }
                            ?>
                        </ul>
                    <?php
                }
            ?>
        </section>
    </main>

    <script src="./js/script.js"></script>
</body>
</html>