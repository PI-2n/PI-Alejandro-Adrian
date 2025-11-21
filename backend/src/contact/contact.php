<?php
session_start();
require_once __DIR__ . '/../includes/json_connect.php';

$errors = [];

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$age = $_POST["age"] ?? null;
$phone = $_POST["phone"] ?? "";
$messageText = trim($_POST["message"] ?? "");
$dataConsent = isset($_POST["dataConsent"]);

if (strlen($name) < 3)
    $errors[] = "El nom ha de tenir almenys 3 caràcters.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    $errors[] = "Correu electrònic no vàlid.";
if ($age < 18 || $age > 99)
    $errors[] = "L'edat ha d'estar entre 18 i 99 anys.";
if (!preg_match("/^[0-9]{9}$/", $phone))
    $errors[] = "El telèfon ha de tenir 9 dígits.";
if (empty($messageText))
    $errors[] = "El missatge no pot estar buit.";
if (!$dataConsent)
    $errors[] = "Has d'acceptar el consentiment de dades.";

if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    header("Location: ../../../frontend/templates/tmp_contact.php");
    exit;
}

$newMessage = [
    "name" => $name,
    "email" => $email,
    "age" => $age,
    "phone" => $phone,
    "message" => $messageText,
    "date" => date("c")
];

// Usar jsonRequest como en register.php
$result = jsonRequest('POST', '/messages', $newMessage);

if ($result['status'] === 201) {
    $_SESSION["exito"] = "Missatge enviat correctament!";
} else {
    $_SESSION["errors"] = ["Hi ha hagut un error enviant el missatge."];
}

header("Location: ../../../frontend/templates/tmp_contact.php");
exit;
