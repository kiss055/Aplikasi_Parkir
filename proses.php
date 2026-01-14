<?php
session_start();

// akun sementara (contoh)
$user = "admin";
$pass = "123";

$username = $_POST['username'];
$password = $_POST['password'];

if ($username == $user && $password == $pass) {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;

    header("Location: dashboard.php");
    exit;
} else {
    header("Location: login.php?error=1");
    exit;
}