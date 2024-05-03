<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = (int)$_POST["number"];

    function fibonacciRecursive($n) {
        if ($n <= 1) {
            return $n;
        }
        return fibonacciRecursive($n - 1) + fibonacciRecursive($n - 2);
    }

    function fibonacciIterative($n) {
        $fib = [];
        $fib[0] = 0;
        $fib[1] = 1;
        for ($i = 2; $i <= $n; $i++) {
            $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
        }
        return $fib[$n];
    }

    function measurePerformance($n) {
        $startRecursive = microtime(true);
        fibonacciRecursive($n);
        $endRecursive = microtime(true);

        $startIterative = microtime(true);
        fibonacciIterative($n);
        $endIterative = microtime(true);

        $recursiveTime = $endRecursive - $startRecursive;
        $iterativeTime = $endIterative - $startIterative;

        if ($recursiveTime < $iterativeTime) {
            $faster = "Recursive";
            $difference = $iterativeTime - $recursiveTime;
        } else {
            $faster = "Iterative";
            $difference = $recursiveTime - $iterativeTime;
        }

        echo "<h2>Performance Results:</h2>";
        echo "<p>Recursive Time: " . $recursiveTime . " seconds</p>";
        echo "<p>Iterative Time: " . $iterativeTime . " seconds</p>";
        echo "<p>$faster function is faster by " . $difference . " seconds</p>";
    }

    measurePerformance($number);
}