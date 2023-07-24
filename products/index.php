<?php

session_start();

require("/xampp/htdocs/entity/user.php");
require("/xampp/htdocs/entity/product.php");
require("/xampp/htdocs/entity/productInCart.php");

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
                ?>
                    <div class="menu-list">
                        <button id="add-product-show" class="btn btn-green btn-fill">Add product</button>
                        <button id="cart-show" class="btn btn-green btn-fill">Cart</button>
                    </div>
                <?php
                require("/xampp/htdocs/products/add/menu.php");
                require("/xampp/htdocs/products/cart/menu.php");
            }
        ?>
        <section class="products">
            <?php

                require("/xampp/htdocs/products/get.php");

                $products = getProducts();

                if (!empty($products)) {
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
                                        <?php
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
                                        ?>
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