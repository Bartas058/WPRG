<?php global $conn;
include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Car</title>
</head>
<body>
<table>
    <tr>
        <td><a href="index.php">Homepage</a></td>
        <td><a href="all_cars.php">All cars</a></td>
        <td><a href="add_car.php">Add car</a></td>
    </tr>
</table>

<h1>Add car</h1>
<form action="add_car.php" method="post">
    <label for="brand">Brand:</label><br>
    <input type="text" id="brand" name="brand"><br>
    <label for="model">Model:</label><br>
    <input type="text" id="model" name="model"><br>
    <label for="price">Price:</label><br>
    <input type="number" id="price" name="price" step="0.01"><br>
    <label for="year">Year:</label><br>
    <input type="number" id="year" name="year"><br>
    <label for="description">Description:</label><br>
    <textarea id="description" name="description"></textarea><br>
    <input type="submit" value="Submit">
</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $year = $_POST['year'];
    $description = $_POST['description'];

    $sql = "INSERT INTO cars (brand, model, price, year, description)
        VALUES ('$brand', '$model', '$price', '$year', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "The new car has been added!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

</body>
</html>