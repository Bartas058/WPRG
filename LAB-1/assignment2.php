<?php

function isPrimeNumber($number) {
    if ($number < 2) {
        return false;
    }
    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i == 0) {
            return false;
        }
    }
    return true;
}

function printPrimeNumbers($begin, $end) {
    for ($i = $begin; $i <= $end; $i++) {
        if (isPrimeNumber($i)) {
            echo $i . " \n";
        }
    }
}

$begin = 2;
$end = 11;

echo "Prime numbers from $begin to $end: \n";
printPrimeNumbers($begin, $end);

?>