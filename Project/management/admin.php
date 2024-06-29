<?php
session_start();
require '../includes/config.php';
require '../model/User.php';

global $connection;

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../home.php');
    exit();
}

$userClass = new User($connection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_user']) && isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        $userClass->deleteUserById($user_id);
    }

    if (isset($_POST['change_role']) && isset($_POST['user_id']) && isset($_POST['role'])) {
        $user_id = $_POST['user_id'];
        $role = $_POST['role'];
        $userClass->changeUserRoleById($user_id, $role);
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

$userClass = new User($connection);
$users = $userClass->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../style/style-crud.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
</head>
<body>
<h1>Admin Panel</h1>
<p>Hello, <b><?php echo $_SESSION['username']; ?></b>! You are logged in as admin!</p>
<h2>User Management</h2>
<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
        <?php $loggedInUserId = $_SESSION['user_id']; ?>
    </tr>
    <?php foreach ($users as $user): ?>
        <?php if ($user['id'] != $loggedInUserId): ?>
            <tr>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <label>
                            <select name="role">
                                <option value="admin" <?php echo ($user['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                                <option value="author" <?php echo ($user['role'] === 'author') ? 'selected' : ''; ?>>Author</option>
                                <option value="user" <?php echo ($user['role'] === 'user') ? 'selected' : ''; ?>>User</option>
                            </select>
                        </label>
                        <button type="submit" name="change_role">Change Role</button>
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <button type="submit" name="delete_user">Delete User</button>
                    </form>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>
<a href="../home.php">Homepage</a>
</body>
</html>