<?php

$allowedIpsFile = 'allowed_ips.txt';

$userIp = $_SERVER['REMOTE_ADDR'];

if (!file_exists($allowedIpsFile)) {
    echo "The file $allowedIpsFile does not exist.";
    exit;
}

$allowedIps = file($allowedIpsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if (in_array($userIp, $allowedIps)) {
    include 'special_page.php';
} else {
    include 'default_page.php';
}