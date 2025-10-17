<?php
session_start();
$errors = $_SESSION["errors"] ?? [];
$exito = $_SESSION["exito"] ?? null;

unset($_SESSION["errors"], $_SESSION["exito"]);
?>

<!DOCTYPE html>
<html lang="ca">

<head>
  <meta charset="UTF-8" />
  <title>Formulari de contacte</title>
  <link rel="stylesheet" href="css/styles.css">  
</head>

<body>
  <h1>Contacta amb nosaltres</h1>
  <form
    action="../backend/formulario-validacion.php"
    id="contactForm"
    method="post">
    <label for="name">Nom:</label>
    <input
      type="text"
      id="name"
      name="name"
      minlength="3" /><br /><br />

    <label for="email">Correu:</label>
    <input type="email" id="email" name="email" /><br /><br />

    <label for="age">Edat:</label>
    <input type="number" id="age" name="age" min="18" max="99" /><br /><br />
    <label for="phone">Teléfono:</label>
    <input
      type="tel"
      id="phone"
      name="phone"
      pattern="[0-9]{9}"
      placeholder="Ex: 600123456" /><br /><br />
    <input type="checkbox" id="dataConsent" name="dataConsent" />
    <label for="dataConsent">Consentimiento de datos</label><br /><br />

    <button type="submit">Enviar</button>
    <button type="reset">Eliminar datos</button>
  </form>

  <script src="validacio.js"></script>
</body>

</html>

<?php if (!empty($errors)): ?>
  <div class="error">
    <h3> Se han encontrado errores:</h3>
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php elseif ($exito): ?>
  <div class="ok">
    <?= htmlspecialchars($exito) ?>
  </div>
<?php endif; ?>

</body>

</html>