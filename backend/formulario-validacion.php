<?php
session_start();
const REGEXP_TELEFONO = '/^(?:\+34|0034)?[6789]\d{8}$/';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recoger y limpiar los datos
    $name = trim($_POST["name"] ?? "");
    $age  = trim($_POST["age"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $dataConsent = trim($_POST["dataConsent"] ?? "");

    $errors = [];

    // Validar
    if (empty($name)) {
        $errors[] = "Por favor, escribe tu nombre.";
    }
    if (empty($email)) {
        $errors[] = "Por favor, escribe tu correo electrónico.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "El correo electrónico no es válido.";
    }
    if (empty($phone)) {
        $errors[] = "Por favor, escribe tu teléfono.";
    } elseif (!preg_match(REGEXP_TELEFONO, $phone)) {
        $errors[] = "El teléfono no es válido";
    }
    if (empty($age)) {
        $errors[] = "Por favor, introduce tu edad.";
    } elseif ($age < 18 || $age > 99) {
        $errors[] = "La edad no es válida.";
    }

    if (!($dataConsent)) {
        $errors[] = "Debes aceptar el consentimiento de datos.";
    }

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
    } else {
        $_SESSION["exito"] = "Formulario enviado correctamente. ¡Gracias, $name!";
    }

    header("Location: ../frontend/index.php");
    exit;
}
