<?php

$counterFile = 'licznik.txt';

if (!file_exists($counterFile)) {
    file_put_contents($counterFile, '1');
    $visitCount = 1;
} else {
    $visitCount = (int) file_get_contents($counterFile);
    $visitCount++;
    file_put_contents($counterFile, $visitCount);
}

echo "<h1>Number of Visits: $visitCount</h1>";