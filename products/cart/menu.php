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
                    <li data-product="<?php echo $productInCart->getProduct()->getId() ?>" class="cart-item">
                        <h3><?php echo $productInCart->getProduct()->getProductName() ?></h3>
                        <div class="amount">
                            <button data-action="substract" class="btn btn-blue btn-hover <?php if ($productInCart->getAmount() < 2) echo "btn-disabled" ?>">
                                &lt;
                            </button>
                            <p><?php echo $productInCart->getAmount() ?></p>
                            <button data-action="add" class="btn btn-blue btn-hover">
                                &gt;
                            </button>
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