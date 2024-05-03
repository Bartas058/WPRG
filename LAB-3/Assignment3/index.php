<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory Management</title>
</head>
<body>

<?php

function handle_directory($path, $directory_name, $operation = 'read') {
    if (substr($path, -1) !== '/') {
        $path .= '/';
    }

    if (!file_exists($path)) {
        return "The path does not exist!";
    }

    switch ($operation) {
        case 'read':
            $contents = scandir($path . $directory_name);
            $contents = array_diff($contents, array('.', '..'));
            return "Elements in the directory: " . implode(', ', $contents);
            break;
        case 'delete':
            if (!file_exists($path . $directory_name)) {
                return "The directory does not exist!";
            }
            if (count(glob($path . $directory_name . '/*')) === 0) {
                if (rmdir($path . $directory_name)) {
                    return "The directory has been removed!";
                } else {
                    return "Failed to delete the directory!";
                }
            } else {
                return "The directory is not empty!";
            }
            break;
        case 'create':
            if (mkdir($path . $directory_name)) {
                return "The directory has been created!";
            } else {
                return "Failed to create a directory!";
            }
            break;
        default:
            return "Unknown operation!";
            break;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $path = $_POST["path"];
    $directory_name = $_POST["directory_name"];
    $operation = isset($_POST["operation"]) ? $_POST["operation"] : 'read';

    $result = handle_directory($path, $directory_name, $operation);
    echo $result;
}

?>

</body>
</html>