<?php

session_start();

require(__DIR__."/../entity/user.php");
require(__DIR__."/../entity/product.php");
require(__DIR__."/../entity/productInCart.php");

if (isset($_SESSION["currentUser"])){
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

    <script src="./js/cart.js"></script>
</head>
<body>
    <header>
        <nav>
            <a href="http://localhost:80/users" class="btn btn-blue btn-hover">Manage users</a>
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
                if (!isset($_GET["PEdit"]) && !isset($_GET["PDelete"])) {
                ?>
                    <div class="menu-list">
                        <button id="add-product-show" class="btn btn-green btn-fill">Add product</button>
                        <button id="cart-show" class="btn btn-green btn-fill">Cart</button>
                    </div>
                <?php
                    require(__DIR__."/add/menu.php");
                    require(__DIR__."/cart/menu.php");
                }
            }
        ?>
        <section class="products">
            <?php

                require(__DIR__."/get.php");

                if (!isset($_GET["PEdit"]) && !isset($_GET["PDelete"])) {

                    $products = getAllProducts();
    
                    if (!empty($products)) {
                        ?>
                            <ul class="product-list">
                                <?php
                                foreach($products as $p) {
                                    $product = new Product(
                                        $p["id"],
                                        $p["productName"],
                                        $p["productDesc"],
                                        $p["productPrice"],
                                        $p["publisherFirstName"]." ".$p["publisherLastName"],
                                        $p["updatedDate"]
                                    );
    
                                    $isInCart = false;
    
                                    if (!empty($cart)) {
                                        foreach($cart as $productInCart) {
                                            if ($product->getId() === $productInCart->getProduct()->getId()) {
                                                $isInCart = true;
                                                break;
                                            }
                                        }
                                    }
    
                                    ?>
                                        <li class="product">
                                            <h3><?php echo $product->getProductName() ?></h3>
                                            <p class="description"><?php echo $product->getProductDesc() ?></p>
                                            <p class="price">$<?php echo $product->getProductPrice() ?></p>
                                            <p class="publisher">Published by <?php echo $product->getPublishedBy() ?></p>
                                            <?php
                                                if (isset($_SESSION["currentUser"])) {
                                                    if (!$isInCart) {
                                                        ?>
                                                            <a
                                                            href=
                                                            "http://localhost:80/products/cart/add.php/?productId=<?php echo $product->getId() ?>"
                                                            class="btn btn-blue btn-hover"
                                                            >Add to cart</a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <button class="btn btn-disabled">Is in cart</button>
                                                        <?php
                                                    }
                                                    if ($_SESSION["currentUser"]["id"] === $p["publishedBy"]) {
                                                        ?>
                                                            <div class="options">
                                                                <a href="http://localhost:80/products/?PEdit=<?php echo $product->getId() ?>">
                                                                    <?php include(__DIR__."/../assets/edit.html") ?>
                                                                </a>
                                                                <a href="http://localhost:80/products/?PDelete=<?php echo $product->getId() ?>">
                                                                    <?php include(__DIR__."/../assets/delete.html") ?>
                                                                </a>
                                                            </div>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        <?php
                    }
                } else {
                    if (isset($_GET["PEdit"])) {
                        require(__DIR__."/edit/menu.php");
                    }
                    if (isset($_GET["PDelete"])) {
                        require(__DIR__."/delete/confirmation.php");
                    }
                }
            ?>

        </section>
    </main>

    <script src="./js/script.js"></script>
</body>
</html>