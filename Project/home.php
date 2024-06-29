<?php
session_start();
require 'includes/config.php';
require 'model/Article.php';

global $connection;

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: home.php');
    exit();
}

$postClass = new Article($connection);
$posts = $postClass->getAllPosts();
$groupedPosts = $postClass->groupPostsByDate($posts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Football Fans</title>
    <link rel="stylesheet" href="style/style-blog.css">
    <link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon">
</head>
<body>
<h1>Football Blog</h1>
<div class="container">
    <div class="button-container">
        <?php if (isset($_SESSION['user_id'])): ?>
            <form method="post">
                <button type="submit" name="logout" class="logout-button">Log Out</button>
            </form>
                <a href="auth/reset.php">Reset Password</a>
                <a href="management/admin.php">Admin Panel</a>
            <?php else: ?>
                <a href="auth/login.php">Log In</a>
                <a href="auth/signup.php">Sign Up</a>
            <?php endif; ?>
            <a href="management/contact.php">Contact</a>
            <a href="article/post.php">Add New Article</a>
    </div>
</div>
<hr>
<?php foreach ($groupedPosts as $date => $posts): ?>
    <h2><?php echo htmlspecialchars($date); ?></h2>
    <?php foreach ($posts as $index => $post): ?>
        <div>
            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                <?php if ($post['image_path']): ?>
            <div class="img-container">
                <img src="<?php echo htmlspecialchars($post['image_path']); ?>" alt="Image">
            </div>
                <?php endif; ?>
                <p>Published: <?php echo $post['created_at']; ?></p>
            <div class="post">
                <div class="post-links">
                    <a href="article/patch.php?id=<?php echo $post['id']; ?>">Edit</a>
                    <a href="article/delete.php?id=<?php echo $post['id']; ?>">Delete</a>
                    <a href="article/get.php?id=<?php echo $post['id']; ?>">See more</a>
                </div>
            </div>
        </div>
        <hr>
    <?php endforeach; ?>
<?php endforeach; ?>
</body>
</html>