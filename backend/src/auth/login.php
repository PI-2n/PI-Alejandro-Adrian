<?php
require_once __DIR__ . '/../includes/json_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $response = jsonRequest('GET', "/users?nom_usuari={$username}");

    if ($response['status'] !== 200 || empty($response['data'])) {
        $_SESSION['error'] = "Usuario no encontrado";
        header('Location: ../../../frontend/templates/login.php');
        exit;
    }

    $user = $response['data'][0];

    $valid = str_starts_with($user['contrasenya'], '$2y$')
        ? password_verify($password, $user['contrasenya'])
        : $password === $user['contrasenya'];

    if (!$valid) {
        $_SESSION['error'] = "Contraseña incorrecta";
        header('Location: ../../../frontend/templates/login.php');
        exit;
    }

    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    setcookie('user_id', $user['id'], time() + 3600, "/");
    header('Location: ../../../frontend/templates/profile.php');
    exit;
}
