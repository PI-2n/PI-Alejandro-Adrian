<?php
session_start();

$userId = $_SESSION['user_id'] ?? $_COOKIE['user_id'] ?? null;
$isLogged = !empty($userId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PI AlejandoAdrian</title>
    <link rel="stylesheet" href="../frontend/css/styles.css">
</head>

<body>
    <h1>Bienvenido</h1>

    <?php if ($isLogged): ?>
        <p>Iniciado sesión como: <strong><?= htmlspecialchars($userId) ?></strong></p>
        <ul>
            <li><a href="../frontend/templates/profile.php">Profile</a></li>
            <li><a href="../backend/auth/logout.php">Logout</a></li>
        </ul>
    <?php else: ?>
        <p>No estás registrado todavía!</p>
        <ul>
            <li><a href="../frontend/templates/register.php">Register</a></li>
            <li><a href="../frontend/templates/login.php">Login</a></li>
        </ul>
    <?php endif; ?>
</body>

</html>