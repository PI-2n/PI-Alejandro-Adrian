<?php
session_start(); // SIEMPRE PRIMERO
$pageTitle = 'Login';

$userId = $_SESSION['user_id'] ?? $_COOKIE['user_id'] ?? null;
if ($userId) {
  // Redirigir al controlador del perfil para cargar datos
  header('Location: /backend/src/auth/profile.php');
  exit;
}

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<?php include __DIR__ . '/partials/header.php';?>

<?php if ($error): ?>
  <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="/backend/src/auth/login.php">
  <label>Usuario: <input type="text" name="username" required></label><br>
  <label>Contraseña: <input type="password" name="password" required></label><br>
  <button type="submit">Login</button>
</form>

<p>No tienes cuenta? <a href="tmp_register.php"><b>Regístrate</b></a></p>

<?php include __DIR__ . '/partials/footer.php'; ?>