<?php
require 'config.php';
require 'models/user.php';

$email = $_POST['email'];
$password = $_POST['password'];

$user = findUserByEmail($db, $email);

if ($user && password_verify($password, $user['password'])) {
    session_start();
    $_SESSION['user_id'] = (string) $user['_id'];
    header('Location: views/home.php');
} else {
    echo "Email atau password salah!";
}
