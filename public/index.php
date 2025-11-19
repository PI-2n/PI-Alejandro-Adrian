<?php
session_start();

$userId = $_SESSION['user_id'] ?? $_COOKIE['user_id'] ?? null;
$isLogged = !empty($userId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/styles_index.css" />
  <title>Document</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet" />
</head>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    // Selecciona todos los productos
    const products = document.querySelectorAll(".product");
    products.forEach((product) => {
      const video = product.querySelector(".product-video");
      if (!video) return; // saltar si no tiene video
      let hoverTimer;
      product.addEventListener("mouseenter", () => {
        // Espera 0.3s para dejar que se vea la animación de escala
        hoverTimer = setTimeout(() => {
          product.classList.add("show-video");
          video.currentTime = 0;
          video.play();
        }, 300);
      });
      product.addEventListener("mouseleave", () => {
        clearTimeout(hoverTimer);
        product.classList.remove("show-video");
        video.pause();
        video.currentTime = 0;
      });
    });
  });
</script>

<body>
  <header>
    <div class="header_image">
      <a href="index.html">
        <img src="img/img_logo.png" alt="Logo" />
      </a>
    </div>

    <div class="header_searchBar">
      <form class="search-form" action="/search" method="get" role="search" aria-label="Buscar en el sitio">
        <label for="q" class="visually-hidden"></label>
        <input id="q" class="search-input" name="q" type="search" placeholder="Buscar..." aria-label="Texto de búsqueda"
          required />
        <button class="search-btn" type="submit">
          <img src="img/img_lupa.png" alt="Buscar" />
        </button>
      </form>
    </div>

    <div class="header_btn-container">
      <div class="platform-btn-container">
        <a href="" rel="noopener">
          <img src="img/img_steam.png" alt="Steam" class="platform-btn" />
        </a>
        <a href="" rel="noopener">
          <img src="img/img_ps.png" alt="PlayStation" class="platform-btn" />
        </a>
        <a href="" rel="noopener">
          <img src="img/img_xbox.png" alt="Xbox" class="platform-btn" />
        </a>
        <a href="" rel="noopener">
          <img src="img/img_switch.png" alt="Nintendo Switch" class="platform-btn" />
        </a>
        <a href="" rel="noopener">
          <img src="img/img_pc.png" alt="PC Software" class="platform-btn" />
        </a>
      </div>
      <div class="separator"></div>
      <div class="user-btn-container">
        <a href="../frontend/templates/login.php" rel="noopener">
          <img src="img/img_user.png" alt="Iniciar Sesión" class="user-btn" />
        </a>
        <a href="" rel="noopener">
          <img src="img/img_carrito.png" alt="Carrito" class="user-btn" />
        </a>
      </div>
    </div>
  </header>

  <main>

    <section class="featured">
      <video src="video/hollow_knight_silksong.mp4" muted loop autoplay class="featured-background-video"></video>
      <a href="#" class="featured-link">
        <h1 class="featured-title">Hollow Knight: Silksong</h1>
        <p class="featured-subtitle">Ya disponible</p>
      </a>
    </section>

    <section class="news">
      <h2>Últimas novedades</h2>
      <div class="products">
        <div class="product">
          <a href="#">
            <div class="media-container">
              <img src="watermark/cover_silksong.jpg" alt="Hollow Knight: Silksong" class="product-image" />
              <video src="video/hollow_knight_silksong.mp4" muted preload="none" class="product-video"></video>
            </div>
            <div class="product-text">
              <p class="title">Hollow Knight: Silksong</p>
              <p class="price">20.00€</p>
            </div>
          </a>
        </div>
        <div class="product">
          <a href="#">
            <div class="media-container">
              <img src="watermark/cover_celeste.jpg" alt="Celeste" class="product-image" />
              <video src="video/celeste.mp4" muted preload="none" class="product-video"></video>
            </div>
            <div class="product-text">
              <p class="title">Celeste</p>
              <p class="price">20.00€</p>
            </div>
          </a>
        </div>
        <div class="product" id="baldurs-gate">
          <a href="#">
            <div class="media-container">
              <img src="watermark/cover_baldurs_gate.jpg" alt="Baldur's Gate III" class="product-image" />
              <video src="video/baldurs_gate.mp4" muted preload="none" class="product-video"></video>
            </div>
            <div class="product-text">
              <p class="title">Baldur's Gate III</p>
              <p class="price">40.00€</p>
            </div>
          </a>
        </div>
      </div>
    </section>

    <section class="offers">
      <h2>Ofertas</h2>
      <div class="products">
        <div class="product">
          <a href="#">
            <img src="watermark/cover_cuphead.jpg" alt="Cuphead" />
            <div class="product-text">
              <p class="title">Cuphead</p>
              <p class="price">20.00€</p>
            </div>
          </a>
        </div>
        <div class="product">
          <a href="#">
            <img src="watermark/cover_borderlands4.jpg" alt="Borderlands 4" />
            <div class="product-text">
              <p class="title">Borderlands 4</p>
              <p class="price">20.00€</p>
            </div>
          </a>
        </div>
        <div class="product">
          <a href="#">
            <img src="watermark/cover_pokemon_leyends_ZA.jpg" alt="Pokémon Leyendas Z/A" />
            <div class="product-text">
              <p class="title">Pokémon Leyendas Z/A</p>
              <p class="price">40.00€</p>
            </div>
          </a>
        </div>
        <div class="product">
          <a href="#">
            <img src="watermark/cover_hogwarts_legacy.jpg" alt="Hogwarts Legacy" />
            <div class="product-text">
              <p class="title">Hogwarts Legacy</p>
              <p class="price">20.00€</p>
            </div>
          </a>
        </div>
        <div class="product">
          <a href="#">
            <img src="watermark/cover_baldurs_gate.jpg" alt="baldurs_gate" />
            <div class="product-text">
              <p class="title">Baldurs Gate III</p>
              <p class="price">20.00€</p>
            </div>
          </a>
        </div>
        <div class="product">
          <a href="#">
            <img src="watermark/cover_hogwarts_legacy.jpg" alt="Hogwarts Legacy" />
            <div class="product-text">
              <p class="title">Hogwarts Legacy</p>
              <p class="price">20.00€</p>
            </div>
          </a>
        </div>

        <div class="product">
          <a href="#">
            <img src="watermark/cover_windows11.jpg" alt="Windows 11 OEM" />
            <div class="product-text">
              <p class="title">Windows 11 OEM</p>
              <p class="price">5.00€</p>
            </div>
          </a>
        </div>
      </div>
    </section>
  </main>
  <footer>
    <p>&copy; 2025 BitKeys. Todos los derechos reservados.</p>
  </footer>
</body>

</html>

<!-- 
<body>
    <h1>Bienvenido</h1>

    <?php if ($isLogged): ?>
        <p>Iniciado sesión como: <strong><?= htmlspecialchars($nom_usuari) ?></strong></p>
        <ul>
            <li><a href="../frontend/templates/profile.php">Profile</a></li>
            <form method="POST" action="../backend/src/auth/logout.php">
                <button type="submit">Cerrar sesión</button>
            </form>
        </ul>
    <?php else: ?>
        <p>No estás registrado todavía!</p>
        <ul>
            <li><a href="../frontend/templates/register.php">Register</a></li>
            <li><a href="../frontend/templates/login.php">Login</a></li>
        </ul>
    <?php endif; ?>
</body>

</html>
    -->