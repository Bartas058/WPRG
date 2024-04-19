<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
</head>
<body>
<h2>Result</h2>

<?php

if (isset($_POST['num1'], $_POST['num2'], $_POST['operator'])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operator = $_POST['operator'];

    switch ($operator) {
        case 'add':
            $result = $num1 + $num2;
            break;
        case 'subtract':
            $result = $num1 - $num2;
            break;
        case 'multiply':
            $result = $num1 * $num2;
            break;
        case 'divide':
            if ($num2 != 0) {
                $result = $num1 / $num2;
            } else {
                echo "You cannot divide by zero!";
                exit;
            }
            break;
        default:
            echo "Incorrect operator!";
            exit;
    }

    echo "Result: $result";
} else {
    echo "Fill out all the fields on the form!";
}

?>

</body>
</html>