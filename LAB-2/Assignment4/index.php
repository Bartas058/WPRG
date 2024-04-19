<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Number</title>
</head>
<body>

<?php

function isPrime($number) {
    if ($number <= 1) {
        return [false, 0];
    }
    $iterations = 0;
    for ($i = 2; $i <= sqrt($number); $i++) {
        $iterations++;
        if ($number % $i == 0) {
            return [false, $iterations];
        }
    }
    return [true, $iterations];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST["number"];

    if (!is_numeric($number) || $number <= 0 || strpos($number, '.') !== false) {
        echo "The specified value is not a positive integer!";
    } else {
        $result = isPrime($number);
        if ($result[0]) {
            echo "{$number} is a prime number. Number of iterations: {$result[1]}";
        } else {
            echo "{$number} is not a prime number. Number of iterations: {$result[1]}";
        }
    }
}

?>

</body>
</html>