<?php
session_start();
require '../includes/config.php';
require '../model/Article.php';
require '../model/User.php';

global $connection;

if (!isset($_GET['id'])) {
    header('Location: ../home.php');
    exit();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

$userClass = new User($connection);
$user = $userClass->getUserById($_SESSION['user_id']);

if ($user['role'] == 'user') {
    header('Location: ../home.php');
    exit();
}

$articleClass = new Article($connection);
$article = $articleClass->getPostById($_GET['id']);
$article['created_at'] = date('Y-m-d\TH:i', strtotime($article['created_at']));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $imagePath = $article['image_path'];
    $date = $_POST['date'];

    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imagePath = '../uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    $articleClass->updatePostById($_GET['id'], $title, $content, $imagePath, $date);
    header('Location: ../home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($article['title']); ?></title>
    <link rel="stylesheet" href="../style/style-login_register_reset.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
</head>
<body>
<h1>Edit Article</h1>
<form method="POST" enctype="multipart/form-data">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
    <br>
    <label for="content">Content:</label>
    <textarea id="content" name="content" required><?php echo htmlspecialchars($article['content']); ?></textarea>
    <br>
    <label for="image">Image (Optional):</label>
    <input type="file" id="image" name="image">
    <br>
    <label for="date">Date:</label>
    <input type="datetime-local" id="date" name="date" value="<?php echo htmlspecialchars($article['created_at']); ?>" required>
    <br>
    <button type="submit">Submit</button>
</form>
<a href="../home.php">Return</a>
</body>
</html>