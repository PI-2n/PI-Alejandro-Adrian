<?php
session_start();
$pageTitle = 'Login';
include __DIR__ . '/partials/header.php';

$userId = $_SESSION['user_id'] ?? $_COOKIE['user_id'] ?? null;
if ($userId) {
  header('Location: ./profile.php');
  exit;
}

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<?php if ($error): ?>
  <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="../../backend/src/auth/login.php">
  <label>Usuario: <input type="text" name="username" required></label><br>
  <label>Contraseña: <input type="password" name="password" required></label><br>
  <button type="submit">Login</button>
</form>

<p>No tienes cuenta? <a href="register.php"><b>Regístrate</b></a></p>

<?php include __DIR__ . '/partials/footer.php'; ?>
