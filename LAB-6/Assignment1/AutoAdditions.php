<?php

require_once 'NewAuto.php';

class AutoAdditions extends NewAuto {
    private $alarm;
    private $radio;
    private $airConditioning;

    public function __construct($model, $priceEuro, $exchangeRate, $alarm, $radio, $airConditioning) {
        parent::__construct($model, $priceEuro, $exchangeRate);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->airConditioning = $airConditioning;
    }

    public function calculatePrice() {
        $basePricePLN = parent::calculatePrice();
        $additionsPricePLN = ($this->alarm + $this->radio + $this->airConditioning) * $this->exchangeRate;
        return $basePricePLN + $additionsPricePLN;
    }
}
