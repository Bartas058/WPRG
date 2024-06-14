<?php

require_once 'Product.php';
require_once 'Cart.php';

$product1 = new Product("Laptop", 1500, 1);
$product2 = new Product("Mouse", 50, 2);

$cart = new Cart();

$cart->addProduct($product1);
$cart->addProduct($product2);

echo $cart;
