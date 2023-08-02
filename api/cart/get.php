<?php

session_start();

require(__DIR__."/../../entity/product.php");
require(__DIR__."/../../entity/productInCart.php");
require(__DIR__."/../../products/cart/get.php");


header('Content-Type: application/json; charset=utf-8');

echo json_encode(getCart());

die();

?>