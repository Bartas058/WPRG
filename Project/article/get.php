<?php
session_start();
require '../includes/config.php';
require '../model/Article.php';
require '../model/Comment.php';
require '../model/User.php';

global $connection;

if (!isset($_GET['id'])) {
    header('Location: ../home.php');
    exit();
}

$articleId = $_GET['id'];

$articleClass = new Article($connection);
$article = $articleClass->getPostById($articleId);

$commentClass = new Comment($connection);
$comments = $commentClass->getCommentsByPostId($articleId);

$articles = $articleClass->getAllPosts();
$index = array_search($articleId, array_column($articles, 'id'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($article['title']); ?></title>
    <link rel="stylesheet" href="../style/style-post.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
</head>
<body>
<h1><?php echo htmlspecialchars($article['title']); ?></h1>
<p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
<?php if ($article['image_path']): ?>
    <div class="img-container">
        <img src="<?php echo htmlspecialchars($article['image_path']); ?>" alt="Image">
    </div>
<?php endif; ?>
<p>Published: <?php echo $article['created_at']; ?></p>
<a href="../home.php">Back to homepage</a>
<hr>
<div>
    <?php if ($index > 0): ?>
        <a href="get.php?id=<?php echo $articles[$index - 1]['id']; ?>">Previous</a>
    <?php endif; ?>
    <?php if ($index < count($articles) - 1): ?>
        <a href="get.php?id=<?php echo $articles[$index + 1]['id']; ?>">Next</a>
    <?php endif; ?>
</div>
<hr>
<h2>Comments</h2>
<?php foreach ($comments as $comment): ?>
    <div>
        <p><strong><?php echo htmlspecialchars($comment['username'] ?: 'Guest'); ?></strong></p>
        <p><?php echo nl2br(htmlspecialchars($comment['content'])); ?></p>
        <p>Added: <?php echo $comment['created_at']; ?></p>
    </div>
    <hr>
<?php endforeach; ?>
<a href="../comment/post.php?post_id=<?php echo $article['id']; ?>">Add comment</a>
</body>
</html>