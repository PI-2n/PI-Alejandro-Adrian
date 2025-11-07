<?php
require_once __DIR__ . '/../includes/json_connect.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $response = jsonRequest('GET', "/usuaris?nom_usuari={$username}");
    $user = $response['data'][0] ?? null;

    if (!$user || !password_verify($password, $user['contrasenya'])) {
        $message = "Usuario o contraseña incorrectos";
    } else {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        setcookie('user_id', $user['id'], time() + 3600, "/");
        header('Location: /frontend/templates/profile.php');
        exit;
    }
}

include __DIR__ . '/../../frontend/templates/login.php';
