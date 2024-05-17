<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    if ($file['error'] == UPLOAD_ERR_OK && is_uploaded_file($file['tmp_name'])) {
        $filePath = $file['tmp_name'];

        $lines = file($filePath, FILE_IGNORE_NEW_LINES);

        if ($lines === false) {
            echo "Error reading the file.";
            exit;
        }

        $reversedLines = array_reverse($lines);

        echo "<h1>Reversed Content</h1>";
        echo "<pre>" . htmlspecialchars(implode("\n", $reversedLines)) . "</pre>";
    } else {
        echo "Error uploading the file.";
    }
} else {
    echo "No file uploaded.";
}