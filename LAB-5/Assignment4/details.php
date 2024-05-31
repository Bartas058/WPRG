<?php global $conn;
include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Car Details</title>
</head>
<body>
<table>
    <tr>
        <td><a href="index.php">Homepage</a></td>
        <td><a href="all_cars.php">All cars</a></td>
        <td><a href="add_car.php">Add car</a></td>
    </tr>
</table>

<h1>Car details</h1>

<?php

$id = $_GET['id'];
$sql = "SELECT * FROM cars WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "ID: " . $row["id"] . "<br>";
    echo "Brand: " . $row["brand"] . "<br>";
    echo "Model: " . $row["model"] . "<br>";
    echo "Price: " . $row["price"] . "<br>";
    echo "Year: " . $row["year"] . "<br>";
    echo "Description: " . $row["description"] . "<br>";
} else {
    echo "Car not found!";
}

?>

<br>
<a href="index.php">Back to home page</a>
</body>
</html>