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

$article = new Article($connection);
$article->deletePostById($_GET['id']);

header('Location: ../home.php');
exit();