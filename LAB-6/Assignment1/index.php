<?php

require_once 'NewAuto.php';
require_once 'AutoAdditions.php';
require_once 'Insurance.php';

$newAuto = new NewAuto("Tesla Model X", 30000, 4.5);
echo "Price in PLN: " . $newAuto->calculatePrice() . "\n";

$autoAdditions = new AutoAdditions("Tesla Model Y", 35000, 4.5, 1000, 500, 2000);
echo "Price with add-ons in PLN: " . $autoAdditions->calculatePrice() . "\n";

$insurance = new Insurance("Model Z", 40000, 4.5, 1500, 700, 2500, 0.1, 5);
echo "Price with add-ons and insurance in PLN: " . $insurance->calculatePrice() . "\n";
