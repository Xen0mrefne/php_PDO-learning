<div class="cart active">
    <button class="close btn btn-red btn-hover">X</button>
    <?php
    
    require("/xampp/htdocs/products/cart/get.php");

    $cart = getCart();

    if (!empty($cart)) {
        ?>
            <ul class="cart-list">
                <?php
                    foreach($cart as $productInCart) {
                        
                        ?>
                            <li class="cart-item">
                                <h3><?php echo $productInCart->getProduct()->getProductName() ?></h3>
                                <div class="quantity">
                                    <button>&lt;</button>
                                    <p><?php echo $productInCart->getAmount() ?></p>
                                    <button>&gt;</button>
                                </div>
                                <button class="remove btn btn-red btn-fill btn-circle">X</button>
                            </li>
                        <?php
                    }
                ?>
            </ul>
        <?php
    }

    
    ?>
</div>