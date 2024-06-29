<?php
session_start();
require '../includes/config.php';
require '../model/Comment.php';

global $connection;

if (!isset($_GET['post_id'])) {
    header('Location: ../home.php');
    exit();
}

$articleId = $_GET['post_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $userId = $_SESSION['user_id'] ?? null;
    $guestName = $userId ? null : 'Guest';

    $comment = new Comment($connection);
    $comment->addComment($articleId, $userId, $guestName, $content);

    header('Location: ../article/get.php?id=' . $articleId);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comment</title>
    <link rel="stylesheet" href="../style/style-create_post_comment.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
</head>
<body>
<h1>Add Comment</h1>
<form method="POST">
    <label for="content">Comment:</label>
    <textarea id="content" name="content" required></textarea>
    <br>
    <button type="submit">Add Comment</button>
</form>
<a href="../article/get.php?id=<?php echo $articleId; ?>">Return To The Article</a>
</body>
</html>