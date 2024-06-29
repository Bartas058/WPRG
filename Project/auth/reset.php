<?php
session_start();
require '../includes/config.php';
require '../model/User.php';

global $connection;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];

    $userClass = new User($connection);
    $user = $userClass->getUserById($_SESSION['user_id']);

    if ($user && password_verify($currentPassword, $user['password'])) {
        $userClass->updateUserPasswordById($user['id'], $newPassword);
        $message = "The password has been reset!";
        header('Location: ../home.php');
        session_destroy();
    } else {
        $error = "The current password is incorrect!";
    }
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../style/style-login_register_reset.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
</head>
<body>
<h1>Reset Password</h1>
<form method="POST">
    <label for="current_password">Current Password:</label>
    <input type="password" id="current_password" name="current_password" required>
    <br>
    <label for="new_password">New Password:</label>
    <input type="password" id="new_password" name="new_password" required>
    <br>
    <?php if (isset($message)): ?>
        <p><b><?php echo $message; ?></b></p>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <p><b><?php echo $error; ?></b></p>
    <?php endif; ?>
    <button type="submit">Submit</button>
</form>
<a href="../home.php">Homepage</a>
</body>
</html>