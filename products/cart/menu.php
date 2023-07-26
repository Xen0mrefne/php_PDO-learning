<div class="cart <?php if (isset($_SESSION["editingCart"])) echo "active" ?>">
    <button class="close btn btn-red btn-hover">X</button>
    <?php
    
    require(__DIR__."/get.php");

    $cart = getCart();

    if (!empty($cart)) {
        ?>
            <ul class="cart-list">
                <?php
                foreach($cart as $productInCart) {  
                    ?>
                    <li class="cart-item">
                        <h3><?php echo $productInCart->getProduct()->getProductName() ?></h3>
                        <div class="amount">
                            <a
                            class="btn btn-blue btn-hover <?php if ($productInCart->getAmount() < 2) echo "btn-disabled" ?>"
                            href=
                            "http://localhost:80/products/cart/edit.php?change=substract&ProductId=<?php echo $productInCart->getProduct()->getId() ?>"
                            >
                                &lt;
                            </a>
                            <p><?php echo $productInCart->getAmount() ?></p>
                            <a
                            class="btn btn-blue btn-hover"
                            href=
                            "http://localhost:80/products/cart/edit.php?change=add&ProductId=<?php echo $productInCart->getProduct()->getId() ?>"
                            >
                                &gt;
                            </a>
                        </div>
                        <a
                        class="remove btn btn-red btn-fill btn-circle"
                        href="http://localhost:80/products/cart/remove.php/?ProductId=<?php echo $productInCart->getProduct()->getId() ?>"
                        >
                            X
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        <?php
    }
    ?>
</div>

<?php

$_SESSION["editingCart"] = null;

?>