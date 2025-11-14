<?php
require_once __DIR__ . '/../includes/json_connect.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');

    if ($username === '' || $email === '' || $password === '') {
        $message = "Por favor rellene los campos necesarios";
    } else {
        $existing = jsonRequest('GET', "/usuaris?nom_usuari={$username}");
        if (!empty($existing['data'])) {
            $message = "El nombre de usario ya existe";
        } else {
            $newUser = [
                "nom_usuari" => $username,
                "contrasenya" => password_hash($password, PASSWORD_DEFAULT),
                "email" => $email,
                "nom" => $firstName,
                "cognoms" => $lastName,
                "data_registre" => date('c')
            ];

            $result = jsonRequest('POST', "/usuaris", $newUser);
            if ($result['status'] === 201) {
                $message = "Usuario registrado con éxito";
                $_SESSION["exito"];
            } else {
                $message = "Error registrando usuario";
            }
        }
    }
}

include __DIR__ . '/../../frontend/templates/register.php';
