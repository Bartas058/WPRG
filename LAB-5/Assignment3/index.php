<?php

$visit_count_cookie = "visit_count";
$last_visit_cookie = "last_visit";
$max_visits = 5;
$visit_interval = 60 * 5;

$current_time = time();

if(isset($_COOKIE[$last_visit_cookie])) {
    $last_visit_time = $_COOKIE[$last_visit_cookie];
} else {
    $last_visit_time = 0;
}

if(($current_time - $last_visit_time) > $visit_interval) {
    if(isset($_COOKIE[$visit_count_cookie])) {
        $visit_count = $_COOKIE[$visit_count_cookie];
        $visit_count++;
    } else {
        $visit_count = 1;
    }

    setcookie($visit_count_cookie, $visit_count, time() + (86400 * 30), "/");
    setcookie($last_visit_cookie, $current_time, time() + (86400 * 30), "/");

    if ($visit_count >= $max_visits) {
        echo "<p>Congratulations! You have visited this page $visit_count times!</p>";
    } else {
        echo "<p>This is your visit number $visit_count. Visit us " . ($max_visits - $visit_count) . " more times to see the special message!</p>";
    }
} else {
    if(isset($_COOKIE[$visit_count_cookie])) {
        $visit_count = $_COOKIE[$visit_count_cookie];
    } else {
        $visit_count = 1;
    }
    echo "<p>This is your visit number $visit_count. Visit us " . ($max_visits - $visit_count) . " more times to see the special message! (A page refresh is not counted as a new visit)!</p>";
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