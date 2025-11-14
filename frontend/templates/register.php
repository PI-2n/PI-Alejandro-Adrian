<?php
$pageTitle = 'Register';
include __DIR__ . '/partials/header.php';
session_start();
?>

<?php if (!empty($message) && !empty($_SESSION["exito"])): ?>
  <p style="color: green;"><?= htmlspecialchars($message) ?></p>
<?php elseif (!empty($message)): ?>
  <p style="color: red;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>


<form method="POST" action="../../../backend/src/auth/register.php">
  <label>Usuario: <input type="text" name="username" required></label><br>
  <label>Email: <input type="email" name="email" required></label><br>
  <label>Contraseña: <input type="password" name="password" required></label><br>
  <label>Nombre: <input type="text" name="first_name"></label><br>
  <label>Apellidos: <input type="text" name="last_name"></label><br>
  <button type="submit">Register</button>
</form>

<p>Ya tienes una cuenta? <a href="login.php"><b>Inicia sesión</b></a></p>

<?php include __DIR__ . '/partials/footer.php'; ?>