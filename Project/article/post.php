<?php
session_start();
require '../includes/config.php';
require '../model/Article.php';
require '../model/User.php';

global $connection;

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

$userClass = new User($connection);
$user = $userClass->getUserById($_SESSION['user_id']);

if ($user['role'] !== 'admin' && $user['role'] !== 'author') {
    header('Location: ../home.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $imagePath = null;

    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imagePath = '../uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    $article = new Article($connection);
    $article->setTitle($title);
    $article->setContent($content);
    if ($imagePath !== null) {
        $article->setImagePath($imagePath);
    }
    $article->addPost();

    header('Location: ../home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Article</title>
    <link rel="stylesheet" href="../style/style-create_post_comment.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
</head>
<body>
<h1>Add New Article</h1>
<form method="POST" enctype="multipart/form-data">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>
    <br>
    <label for="content">Content:</label>
    <textarea id="content" name="content" required></textarea>
    <br>
    <label for="image">Image (Optional):</label>
    <input type="file" id="image" name="image">
    <br>
    <button type="submit">Submit</button>
</form>
<a href="../home.php">Return</a>
</body>
</html>