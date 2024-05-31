<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['card_number'] = $_POST['card_number'];
    $_SESSION['order_name'] = $_POST['order_name'];
    $_SESSION['num_people'] = $_POST['num_people'];
    header('Location: people.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reservation Step 1</title>
</head>
<body>
<h1>Step 1: General Information</h1>
<form method="post" action="index.php">
    <label for="card_number">Card Number:</label>
    <input type="text" id="card_number" name="card_number" required><br>

    <label for="order_name">Name:</label>
    <input type="text" id="order_name" name="order_name" required><br>

    <label for="num_people">Number of People:</label>
    <input type="number" id="num_people" name="num_people" required><br>

    <input type="submit" value="Next">
</form>
</body>
</html>