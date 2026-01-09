<?php
$userId = $_SESSION['user_id'] ?? $_COOKIE['user_id'] ?? null;
$isLogged = !empty($userId);

// Definimos el título por defecto si no viene de la página
$pageTitle = $pageTitle ?? 'BitKeys';

/**
 * Función auxiliar para verificar si el icono debe estar activo
 * Compara el título de la página actual con los nombres de sección
 */
function isActive($currentTitle, $sections) {
    return in_array($currentTitle, $sections) ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="/frontend/vendor/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/frontend/css/styles_index.css" />

  <?php if (!empty($customCss)): ?>
    <link rel="stylesheet" href="<?= htmlspecialchars($customCss) ?>" />
  <?php endif; ?>

  <title><?= htmlspecialchars($pageTitle) ?></title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />
  <script src="/frontend/js/header.js" defer></script>
</head>

<body>
  <header>
    <div class="header_image">
      <a href="/">
        <img src="/img/img_logo.png" alt="Logo" />
      </a>
    </div>

    <div class="header_searchBar">
      <form class="search-form" action="/search" method="get" role="search" aria-label="Buscar en el sitio">
        <label for="q" class="visually-hidden"></label>
        <input id="q" class="search-input" name="q" type="search" placeholder="Buscar..." aria-label="Texto de búsqueda"
          required />
        <button class="search-btn" type="submit">
          <img src="/img/img_lupa.png" alt="Buscar" />
        </button>
      </form>
    </div>

    <div class="header_btn-container">
      <div class="platform-btn-container">
        <a href="#" rel="noopener"><img src="/img/img_steam.png" alt="Steam" class="platform-btn <?= isActive($pageTitle, ['Steam']) ?>" /></a>
        <a href="#" rel="noopener"><img src="/img/img_ps.png" alt="PlayStation" class="platform-btn <?= isActive($pageTitle, ['PlayStation', 'PS5']) ?>" /></a>
        <a href="#" rel="noopener"><img src="/img/img_xbox.png" alt="Xbox" class="platform-btn <?= isActive($pageTitle, ['Xbox']) ?>" /></a>
        <a href="#" rel="noopener"><img src="/img/img_switch.png" alt="Nintendo Switch" class="platform-btn <?= isActive($pageTitle, ['Nintendo']) ?>" /></a>
        <a href="#" rel="noopener"><img src="/img/img_pc.png" alt="PC Software" class="platform-btn <?= isActive($pageTitle, ['PC']) ?>" /></a>
      </div>

      <div class="separator"></div>

      <div class="user-btn-container">
        <a href="<?= $isLogged ? '/backend/src/auth/profile.php' : '/frontend/templates/tmp_login.php' ?>"
          rel="noopener">
          <img src="/img/img_user.png" alt="Usuario" 
               class="user-btn <?= isActive($pageTitle, ['Perfil', 'Login', 'Register', 'Register-page']) ?>" />
        </a>
        
        <a href="#" rel="noopener">
          <img src="/img/img_carrito.png" alt="Carrito" 
               class="user-btn <?= isActive($pageTitle, ['Carrito', 'Checkout']) ?>" />
        </a>
      </div>
    </div>
  </header>

  <div class="platform-btn-mobile">
    <a href="#"><img src="/img/img_steam.png" alt="Steam" class="platform-btn" /></a>
    <a href="#"><img src="/img/img_ps.png" alt="PlayStation" class="platform-btn" /></a>
    <a href="#"><img src="/img/img_xbox.png" alt="Xbox" class="platform-btn" /></a>
    <a href="#"><img src="/img/img_switch.png" alt="Nintendo Switch" class="platform-btn" /></a>
    <a href="#"><img src="/img/img_pc.png" alt="PC Software" class="platform-btn" /></a>
  </div>
</body>

</html>