<?php
    require_once __DIR__ . '/../models/db_connection.php';
    require_once __DIR__ . '/../controllers/User.php';
    $user = new User($pdo);

if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    $user->activeUser($email,$token);

    header('Location:?page=login');
}
?>