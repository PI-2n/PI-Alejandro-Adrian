<?php
require_once __DIR__ . '/../includes/json_connect.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $firstName = trim($_POST['name'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');

    if ($username === '' || $email === '' || $password === '') {
        $message = "Por favor rellene los campos necesarios";
    } else {

        // COMPROBAR SI EL USUARIO YA EXISTE (CORRECTO)
        $existing = jsonRequest('GET', "/users?username={$username}");

        if (!empty($existing['data'])) {
            $message = "El nombre de usuario ya existe";
        } else {

            // NUEVO USUARIO
            $newUser = [
                "username" => $username,
                "contrasenya" => password_hash($password, PASSWORD_DEFAULT),
                "email" => $email,
                "name" => $firstName,
                "lastName" => $lastName,
                "data_registre" => date('c')
            ];

            // GUARDAR EN /users (CORRECTO)
            $result = jsonRequest('POST', "/users", $newUser);

            if ($result['status'] === 201) {
                $_SESSION["exito"] = true;
                header('Location: ../../../frontend/templates/tmp_login.php');
                exit;
            } else {
                $message = "Error registrando usuario";
            }
        }
    }
}

include __DIR__ . '/../../frontend/templates/tmp_register.php';
