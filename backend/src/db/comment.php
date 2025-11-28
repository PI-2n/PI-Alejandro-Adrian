<?php
session_start();
require_once __DIR__ . '/../includes/json_connect.php';

// 1. Seguridad: Solo usuarios logueados pueden comentar
$userId = $_SESSION['user_id'] ?? null;
$username = $_SESSION['username'] ?? 'Anónimo';

if (!$userId) {
    $_SESSION['error_comment'] = "Has d'iniciar sessió per comentar.";
    // Redirigimos atrás (a la página del producto de donde venimos)
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'] ?? null;
    $rating = (int)($_POST['rating'] ?? 0);
    $comment = trim($_POST['comment'] ?? '');

    // Validaciones básicas
    if (!$productId || $rating < 1 || $rating > 5 || empty($comment)) {
        $_SESSION['error_comment'] = "Tots els camps són obligatoris i la valoració ha de ser entre 1 i 5.";
        header("Location: /frontend/templates/tmp_product.php?id=" . $productId);
        exit;
    }

    // Preparar datos para json-server
    $newComment = [
        "product_id" => (int)$productId, // Importante castear a int para que coincida con el ID del producto
        "user_id" => $userId,
        "username" => $username,
        "rating" => $rating,
        "comment" => $comment,
        "date" => date('c') // Fecha formato ISO 8601
    ];

    // Enviar a la base de datos
    $result = jsonRequest('POST', '/comments', $newComment);

    if ($result['status'] === 201) {
        $_SESSION['success_comment'] = "Comentari publicat correctament!";
    } else {
        $_SESSION['error_comment'] = "Error al guardar el comentari.";
    }

    // Volver al producto
    header("Location: /frontend/templates/tmp_product.php?id=" . $productId);
    exit;
}