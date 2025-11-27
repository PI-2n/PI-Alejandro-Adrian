<?php
session_start();
$pageTitle = 'Contacte'; // Definimos el título para el header

// Recuperar errores o mensajes de éxito de la sesión
$errors = $_SESSION["errors"] ?? [];
$exito = $_SESSION["exito"] ?? null;

// Limpiar la sesión para que no salgan los mensajes al recargar
unset($_SESSION["errors"], $_SESSION["exito"]);
?>

<?php include __DIR__ . '/partials/header.php'; ?>

<main>
  <h1>Contacta amb nosaltres</h1>

  <?php if (!empty($errors)): ?>
    <div class="error" style="color: red; margin-bottom: 20px;">
      <h3>S'han trobat errors:</h3>
      <ul>
        <?php foreach ($errors as $error): ?>
          <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php elseif ($exito): ?>
    <div class="ok" style="color: green; margin-bottom: 20px; font-weight: bold;">
      <?= htmlspecialchars($exito) ?>
    </div>
  <?php endif; ?>

  <form action="/backend/src/contact/contact.php" id="contactForm" method="post">
    <h3><label for="name">Nom:</label></h3>
    <input type="text" id="name" name="name" minlength="3" placeholder="Pedro" required />

    <h3><label for="email">Correu:</label></h3>
    <input type="email" id="email" name="email" placeholder="ejemplo@gmail.com" required />

    <h3><label for="age">Edat:</label></h3>
    <input type="number" id="age" name="age" min="18" max="99" />

    <h3><label for="phone">Telèfon:</label></h3>
    <input type="tel" id="phone" name="phone" pattern="[0-9]{9}" placeholder="600123456" /><br><br>

    <h3><label for="message">Missatge:</label></h3>
    <textarea id="message" name="message" placeholder="Escribe tu mensaje" required></textarea><br><br>

    <div style="margin-bottom: 15px;">
        <input type="checkbox" id="dataConsent" name="dataConsent" required />
        <label for="dataConsent">Consentiment de dades</label>
    </div>

    <button type="submit">Enviar</button>
    <button type="reset">Eliminar dades</button>
  </form>

</main>

<script src="/frontend/js/validacio.js"></script>

<?php include __DIR__ . '/partials/footer.php'; ?>