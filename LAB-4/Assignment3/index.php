<?php

$linksFile = 'urls.txt';

if (!file_exists($linksFile)) {
    echo "The file $linksFile does not exist.";
    exit;
}

$lines = file($linksFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$links = [];

foreach ($lines as $line) {
    list($url, $description) = explode(';', $line, 2);
    $url = trim($url);
    $description = trim($description);
    $links[] = [
        'url' => $url,
        'description' => $description
    ];
}

echo "<ul>";
foreach ($links as $link) {
    echo "<li><a href=\"" . htmlspecialchars($link['url']) . "\">" . htmlspecialchars($link['description']) . "</a></li>";
}
echo "</ul>";