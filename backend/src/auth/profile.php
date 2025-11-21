<?php
require_once __DIR__ . '/../includes/json_connect.php';
session_start();

$userId = $_SESSION['user_id'] ?? $_COOKIE['user_id'] ?? null;

if (!$userId) {
    header('Location: ../../../frontend/templates/login.php');
    exit;
}

$response = jsonRequest('GET', "/users/{$userId}");

$user = $response['data'] ?? null;

if (!$user || !is_array($user)) {
    session_destroy();
    header('Location: ../../../frontend/templates/login.php');
    exit;
}

$_SESSION['user_id']   = $user['id'];
$_SESSION['username']  = $user['username'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['name'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $email = trim($_POST['email'] ?? '');

    $update = [
        "name" => $firstName,
        "lastName" => $lastName,
        "email" => $email
    ];

    $result = jsonRequest('PATCH', "/users/{$userId}", $update);

    if ($result['status'] === 200) {
        $message = "Perfil actualizado correctamente.";
        $user = array_merge($user, $update);
        $_SESSION["exito"] = true;
    } else {
        $message = "Error actualizando el perfil";
    }
}

include __DIR__ . '/../../frontend/templates/tmp_profile.php';
