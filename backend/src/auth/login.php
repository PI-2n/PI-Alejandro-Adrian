<?php
require_once __DIR__ . '/../includes/json_connect.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $response = jsonRequest('GET', "/users?nom_usuari={$username}");
    
    // Comprobar respuesta HTTP
    if ($response['status'] !== 200 || empty($response['data'])) {
        $message = "Usuario no encontrado";
    } else {
        $user = $response['data'][0];

        // Aceptar contraseñas hash y simples
        $valid = str_starts_with($user['contrasenya'], '$2y$')
            ? password_verify($password, $user['contrasenya'])
            : $password === $user['contrasenya'];

        if (!$valid) {
            $message = "Contraseña incorrecta";
        } else {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            setcookie('user_id', $user['id'], time() + 3600, "/");
            header('Location: ../../../frontend/templates/profile.php');
            exit;
        }
    }
}

include __DIR__ . '/../../../frontend/templates/login.php';
