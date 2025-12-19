<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = 'Register';
$customCss = '/frontend/css/register.css';
$error = $_SESSION['error'] ?? '';
?>

<?php include __DIR__ . '/partials/header.php'; ?>

<main class="register-page">
    <?php if (!empty($_SESSION['exito'])): ?>
        <p style="color: green;">Registro exitoso</p>
    <?php elseif (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form id="registerForm" method="POST" action="/backend/src/auth/register.php" novalidate>
        <label>Nombre*:
            <input type="text" id="name" name="name" required>
            <span class="error"></span>
        </label><br>

        <label>Apellidos*:
            <input type="text" id="lastName" name="lastName" required>
            <span class="error"></span>
        </label><br>

        <label>Email*:
            <input type="email" id="email" name="email" required>
            <span class="error"></span>
        </label><br>

        <label>Usuario*:
            <input type="text" id="username" name="username" required>
            <span class="error"></span>
        </label><br>

        <label>Contraseña*:
            <input type="password" id="password" name="password" required>
            <span class="error"></span>
        </label><br>

        <label>Repetir contraseña*:
            <input type="password" id="password2" name="password2" required>
            <span class="error"></span>
        </label><br>

        <button type="submit">Register</button>
    </form>
    <script src="/frontend/js/validate_register.js"></script>
    <p>Ya tienes una cuenta? <a href="tmp_login.php"><b>Inicia sesión</b></a></p>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>