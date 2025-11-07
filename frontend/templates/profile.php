<?php
$pageTitle = 'Profile';
include __DIR__ . '/partials/header.php';
?>

<?php if (!empty($message) && !empty($_SESSION["exito"])): ?>
  <p style="color: green;"><?= htmlspecialchars($message) ?></p>
<?php elseif (!empty($message)): ?>
  <p style="color: red;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" action="/backend/auth/profile.php">
  <p><strong>Usuario:</strong> <?= htmlspecialchars($user['nom_usuari']) ?></p>
  <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"></label><br>
  <label>Nombre: <input type="text" name="first_name" value="<?= htmlspecialchars($user['nom']) ?>"></label><br>
  <label>Apellidos: <input type="text" name="last_name" value="<?= htmlspecialchars($user['cognoms']) ?>"></label><br>
  <button type="submit">Update</button>
</form>

<p><a href="/backend/auth/logout.php">Cerrar sesión</a></p>

<?php include __DIR__ . '/partials/footer.php'; ?>