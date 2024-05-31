<?php

$cookie_name = "visit_count";
$max_visits = 5;

if(isset($_COOKIE[$cookie_name])) {
    $visit_count = $_COOKIE[$cookie_name];
    $visit_count++;

    setcookie($cookie_name, $visit_count, time() + (86400 * 30), "/");

    if ($visit_count >= $max_visits) {
        echo "<p>Congratulations! You have visited this page $visit_count times!</p>";
    } else {
        echo "<p>This is your visit number $visit_count. Visit us " . ($max_visits - $visit_count) . " more times to see the special message!</p>";
    }
} else {
    $visit_count = 1;
    setcookie($cookie_name, $visit_count, time() + (86400 * 30), "/");
    echo "<p>Welcome, this is your first visit to our website!</p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Visitor counter</title>
</head>
<body>
<h1>Welcome to our website!</h1>
</body>
</html>