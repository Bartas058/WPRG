<?php global $conn;
include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Cars</title>
</head>
<body>
<table>
    <tr>
        <td><a href="index.php">Homepage</a></td>
        <td><a href="all_cars.php">All cars</a></td>
        <td><a href="add_car.php">Add car</a></td>
    </tr>
</table>

<h1>All cars</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Brand</th>
        <th>Model</th>
        <th>Price</th>
    </tr>

    <?php

    $sql = "SELECT id, brand, model, price FROM cars ORDER BY price DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><a href='details.php?id=" . $row["id"] . "'>" . $row["id"] . "</a></td><td>" . $row["brand"] . "</td><td>" . $row["model"] . "</td><td>" . $row["price"] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No cars!</td></tr>";
    }

    ?>

</table>
</body>
</html>