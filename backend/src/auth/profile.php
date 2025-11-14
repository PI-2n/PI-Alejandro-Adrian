<?php
require_once __DIR__ . '/../includes/json_connect.php';
session_start();

$userId = $_SESSION['user_id'] ?? $_COOKIE['user_id'] ?? null;

if (!$userId) {
    header('Location: /frontend/templates/login.php');
    exit;
}

$response = jsonRequest('GET', "/usuaris/{$userId}");
$user = $response['data'] ?? null;

if (!$user) {
    echo "Usuario no encontrado";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    $update = [
        "nom" => $firstName,
        "cognoms" => $lastName,
        "email" => $email
    ];

    $result = jsonRequest('PATCH', "/usuaris/{$userId}", $update);

    if ($result['status'] === 200) {
        $message = "Perfil actualizado correctamente.";
        $user = array_merge($user, $update);
        $_SESSION["exito"];
    } else {
        $message = "Error actualizando el perfil";
    }
}

include __DIR__ . '/../../frontend/templates/profile.php';
