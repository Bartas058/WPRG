<?php
session_start();
require '../includes/config.php';
require '../model/User.php';

global $connection;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_COOKIE['login_attempts']) && $_COOKIE['login_attempts'] >= 5) {
        $error = "Too many failed login attempts. Please try again in 5 minutes.";
    } else {
        $identifier = $_POST['username'];
        $password = $_POST['password'];

        $userClass = new User($connection);
        $user = $userClass->authenticateUser($identifier, $password);

        if ($user) {
            setcookie('login_attempts', '', time() - 3600);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('Location: ../home.php');
            exit();
        } else {
            if (isset($_COOKIE['login_attempts'])) {
                $attempts = $_COOKIE['login_attempts'] + 1;
            } else {
                $attempts = 1;
            }

            setcookie('login_attempts', $attempts, time() + (2 * 60));

            if ($attempts >= 3) {
                $error = "Too many failed login attempts. Please try again in 2 minutes!";
            } else {
                $error = "Invalid login credentials! Attempt $attempts of 3!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <link rel="stylesheet" href="../style/style-login_register_reset.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
</head>
<body>
<h1>Sign In</h1>
<form method="POST">
    <label for="username">Username Or Email Address:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <?php if (isset($error)): ?>
        <p><b><?php echo $error; ?></b></p>
    <?php endif; ?>
    <button type="submit">Sign In</button>
</form>
<a href="signup.php">Sign Up</a>
<a href="../home.php">Homepage</a>
</body>
</html>