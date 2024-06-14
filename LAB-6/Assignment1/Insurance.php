<?php

require_once 'AutoAdditions.php';

class Insurance extends AutoAdditions {
    private $insurancePercentage;
    private $yearsOfOwnership;

    public function __construct($model, $priceEuro, $exchangeRate, $alarm, $radio, $airConditioning, $insurancePercentage, $yearsOfOwnership) {
        parent::__construct($model, $priceEuro, $exchangeRate, $alarm, $radio, $airConditioning);
        $this->insurancePercentage = $insurancePercentage;
        $this->yearsOfOwnership = $yearsOfOwnership;
    }

    public function calculatePrice() {
        $carValuePLN = parent::calculatePrice();
        $discountFactor = (100 - $this->yearsOfOwnership) / 100;
        $insuranceValue = $this->insurancePercentage * ($carValuePLN * $discountFactor);
        return $carValuePLN + $insuranceValue;
    }
}
