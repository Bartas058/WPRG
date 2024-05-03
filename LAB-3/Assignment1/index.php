<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birthday</title>
</head>
<body>

<?php

if(isset($_GET['birthdate'])) {
    $birthdate = $_GET['birthdate'];

    if (strtotime($birthdate) > strtotime('today')) {
        echo "<p>Error: The date of birth entered is later than today!</p>";
    } else {
        $day_of_week = date('N', strtotime($birthdate));
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $day_name = $days[$day_of_week - 1];

        $user_age = date_diff(date_create($birthdate), date_create('today'))->y;

        $next_birthday = date('Y') . '-' . date('m-d', strtotime($birthdate));
        if (strtotime($next_birthday) < strtotime('today')) {
            $next_birthday = (date('Y') + 1) . '-' . date('m-d', strtotime($birthdate));
        }
        $days_until_next_birthday = date_diff(date_create($next_birthday), date_create('today'))->days;

        echo "<p>You were born on: $day_name</p>";
        echo "<p>You have $user_age years old</p>";
        echo "<p>There are $days_until_next_birthday days left until your next birthday</p>";
    }
} else {
    echo "<p>No date of birth given!</p>";
}

?>

</body>
</html>