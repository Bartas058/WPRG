<?php
session_start();
require '../includes/config.php';
require '../model/User.php';

global $connection;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $user = new User($connection);

    if ($user->usernameExists($username)) {
        $error = "Username already exists!";
    } else {
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setEmail($email);
        $user->setRole($role);
        $user->addUser();

        header('Location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../style/style-login_register_reset.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
</head>
<body>
<h1>Sign Up</h1>
<form method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="role" class="form-label">Role:</label>
    <select id="role" name="role" class="form-select" required>
        <option value="author">Author</option>
        <option value="user">User</option>
    </select>
    <?php if (isset($error)): ?>
        <p><b><?php echo $error; ?></b></p>
    <?php endif; ?>
    <button type="submit">Sign Up</button>
</form>
<a href="login.php">Already have an account? Sign In -></a>
<a href="../home.php">Homepage</a>
</body>
</html>