<?php

class NewAuto {
    protected $model;
    protected $priceEuro;
    protected $exchangeRate;

    public function __construct($model, $priceEuro, $exchangeRate) {
        $this->model = $model;
        $this->priceEuro = $priceEuro;
        $this->exchangeRate = $exchangeRate;
    }

    public function calculatePrice() {
        return $this->priceEuro * $this->exchangeRate;
    }
}
