<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking summary</title>
</head>
<body>
<h2>Booking summary</h2>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<p>Details of the person making the booking:</p>";
    echo "<p>First name: {$_POST['first_name']}</p>";
    echo "<p>Last name: {$_POST['last_name']}</p>";
    echo "<p>Address: {$_POST['address']}</p>";
    echo "<p>Email: {$_POST['email']}</p>";
    echo "<p>Credit card details: {$_POST['credit_card']}</p>";
    echo "<p>Arrival date: {$_POST['arrival_date']}</p>";
    echo "<p>Arrival time: {$_POST['arrival_time']}</p>";

    if (isset($_POST["extra_bed"])) {
        echo "<p>Is there a need to provide a bed for a child: Yes</p>";
    } else {
        echo "<p>Is there a need to provide a bed for a child: No</p>";
    }

    if (isset($_POST["amenities"])) {
        echo "<p>Selected amenities:</p>";
        echo "<ul>";
        foreach ($_POST["amenities"] as $amenity) {
            if ($amenity === "air_conditioning") {
                echo "<li>Air conditioning</li>";
            } elseif ($amenity === "ashtray") {
                echo "<li>Ashtray</li>";
            }
        }
        echo "</ul>";
    } else {
        echo "<p>No selected amenities</p>";
    }

    $number_of_people = $_POST["number_of_people"];
    if ($number_of_people > 1) {
        for ($i = 1; $i <= $number_of_people; $i++) {
            echo "<p>Details of the person $i:</p>";
            echo "<p>First name: {$_POST['first_name_'.$i]}</p>";
            echo "<p>Last name: {$_POST['last_name_'.$i]}</p>";
        }
    }
} else {
    echo "<p>The form has not been sent!</p>";
}

?>

</body>
</html>