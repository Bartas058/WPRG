<?php

function fibonacci($n) {
    $fib = array();
    $fib[0] = 0;
    $fib[1] = 1;
    
    for ($i = 2; $i < $n; $i++) {
        $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
    }
    
    return $fib;
}

function printOddElements($arr) {
    foreach ($arr as $key => $value) {
        if ($value % 2 != 0) {
            echo ($key + 1) . ": " . $value . "\n";
        }
    }
}

$number = 8;
$fibonacci_sequence = fibonacci($number);

echo "Odd elements of the Fibonacci sequence:\n";
printOddElements($fibonacci_sequence);

?>