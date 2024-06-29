<?php
session_start();
require '../includes/config.php';
require '../model/User.php';

global $connection;

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

$inactive = 60;

if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_unset();
        session_destroy();
        header('Location: ../auth/login.php');
        exit();
    }
}
$_SESSION['timeout'] = time();

$userModel = new User($connection);
$users = $userModel->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Management</title>
    <link rel="stylesheet" href="../style/style-crud.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
</head>
<body>
<h1>Contact</h1>
<p>Hello, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>! Here you will find the contact details of the blog authors!</p>
<h2>Contact Details</h2>
<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <?php if ($user['role'] === 'author'): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
                <td>
                    <button type="button" onclick="window.location.href='mailto:<?php echo ($user['email']); ?>'">Contact</button>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>
<a href="../home.php">Homepage</a>
</body>
</html>