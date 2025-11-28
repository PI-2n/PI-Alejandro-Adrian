<?php
$pageTitle = 'Profile';
$customCss = '/frontend/css/styles_profile.css';

// Aseguramos que user tenga datos para evitar errores si entras directo
$user = $user ?? []; 
?>

<?php include __DIR__ . '/partials/header.php'; ?>

<?php if (!empty($message) && !empty($_SESSION["exito"])): ?>
  <p style="color: green;"><?= htmlspecialchars($message) ?></p>
<?php elseif (!empty($message)): ?>
  <p style="color: red;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" action="/backend/src/auth/profile.php">
  <p><strong>Usuario:</strong> <?= htmlspecialchars($_SESSION['username'] ?? $user['username'] ?? 'Invitado') ?></p>
  <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>"></label><br>
  <label>Nombre: <input type="text" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>"></label><br>
  <label>Apellidos: <input type="text" name="lastName" value="<?= htmlspecialchars($user['lastName'] ?? '') ?>"></label><br>
  <button type="submit">Update</button>
</form>
<br>

<form method="POST" action="/backend/src/auth/logout.php">
  <button type="submit">Cerrar sesión</button>
</form>

<hr>

<h3>Administración</h3>

<?php if (!empty($_SESSION['success_import'])): ?>
    <p style="color: green; font-weight: bold;"><?= htmlspecialchars($_SESSION['success_import']) ?></p>
    <?php unset($_SESSION['success_import']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['error_import'])): ?>
    <p style="color: red; font-weight: bold;"><?= htmlspecialchars($_SESSION['error_import']) ?></p>
    <?php unset($_SESSION['error_import']); ?>
<?php endif; ?>

<form method="POST" action="/backend/src/db/import_products.php">
    <p>Asegúrate de que el archivo <em>productes.xlsx</em> está en la carpeta <em>uploads</em>.</p>
    <button type="submit" onclick="return confirm('¿Seguro? Esto borrará los productos actuales y recargará el Excel.')">
        🔄 Importar Productos desde Excel
    </button>
</form>

<?php include __DIR__ . '/partials/footer.php'; ?>