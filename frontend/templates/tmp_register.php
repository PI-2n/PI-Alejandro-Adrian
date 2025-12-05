<?php
if (session_status() === PHP_SESSION_NONE) {
session_start();
}

$pageTitle = 'Register';
$customCss = '/frontend/css/styles_register.css';
$error = $_SESSION['error'] ?? ''; // Recuperar mensajes si los hubiera
?>

<?php include __DIR__ . '/partials/header.php'; ?>

<?php if (!empty($_SESSION['exito'])): ?>
<p style="color: green;">Registro exitoso</p>
<?php elseif (!empty($error)): ?>
<p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>


<form id="registerForm" method="POST" action="/backend/src/auth/register.php" novalidate>
<label>Nombre: <input type="text" id="name" name="name" required></label>
<span class="error"></span><br>

<label>Apellidos: <input type="text" id="lastName" name="lastName" required></label>
<span class="error"></span><br>

<label>Email: <input type="email" id="email" name="email" required></label>
<span class="error"></span><br>

<label>Usuario: <input type="text" id="username" name="username" required></label>
<span class="error"></span><br>

<label>Contraseña: <input type="password" id="password" name="password" required></label>
<span class="error"></span><br>

<label>Repetir contraseña: <input type="password" id="password2" name="password2" required></label>
<span class="error"></span><br>

<button type="submit">Register</button>
</form>
<script src="/frontend/js/validate_register.js"></script>
<p>Ya tienes una cuenta? <a href="tmp_login.php"><b>Inicia sesión</b></a></p>

<?php include __DIR__ . '/partials/footer.php'; ?>