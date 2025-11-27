<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$pageTitle = 'Register';
$error = $_SESSION['error'] ?? ''; // Recuperar mensajes si los hubiera
?>

<?php include __DIR__ . '/partials/header.php'; ?>

<?php if (!empty($_SESSION['exito'])): ?>
  <p style="color: green;">Registro exitoso</p>
<?php elseif (!empty($error)): ?>
  <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>


<form method="POST" action="/backend/src/auth/register.php">
  <label>Usuario: <input type="text" name="username" required></label><br>
  <label>Email: <input type="email" name="email" required></label><br>
  <label>Contraseña: <input type="password" name="password" required></label><br>
  <label>Nombre: <input type="text" name="name"></label><br>
  <label>Apellidos: <input type="text" name="lastName"></label><br>
  <button type="submit">Register</button>
</form>

<p>Ya tienes una cuenta? <a href="tmp_login.php"><b>Inicia sesión</b></a></p>

<?php include __DIR__ . '/partials/footer.php'; ?>