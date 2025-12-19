<?php
session_start();

$userId = $_SESSION['user_id'] ?? $_COOKIE['user_id'] ?? null;
$isLogged = !empty($userId);

$pageTitle = "Inicio - BitKeys";
include __DIR__ . '/../frontend/templates/partials/header.php';
?>

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

<main>

  <!-- SECCIÓN DESTACADA -->
  <section class="featured">
    <video src="video/hollow_knight_silksong.mp4" muted loop autoplay class="featured-background-video"></video>
    <a href="/frontend/templates/tmp_product.php?id=3" class="featured-link">
      <h1 class="featured-title">Hollow Knight: Silksong</h1>
      <p class="featured-subtitle">Ya disponible</p>
    </a>
  </section>

  <!-- SECCIÓN NEWS -->
  <section class="news">
    <h2>Últimas novedades</h2>
    <!-- data-bs-ride=false mantiene el carrusel estático si el usuario no lo toca -->
    <div id="newsCarousel" class="carousel slide" data-bs-ride="false">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="products">
            <div class="product">
              <a href="/frontend/templates/tmp_product.php?id=3">
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
              <a href="/frontend/templates/tmp_product.php?id=5">
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
              <a href="/frontend/templates/tmp_product.php?id=4">
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
        </div>
        <div class="carousel-item">
          <div class="products">
            <div class="product">
              <a href="/frontend/templates/tmp_product.php?id=3">
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
              <a href="/frontend/templates/tmp_product.php?id=3">
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
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
      </button>
    </div>
  </section>

  <!-- SECCIÓN OFFERS -->
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

<?php include __DIR__ . '../../frontend/templates/partials/footer.php'; ?>