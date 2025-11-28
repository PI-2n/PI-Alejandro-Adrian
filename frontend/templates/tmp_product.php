<?php
session_start(); // SIEMPRE PRIMERO

require_once __DIR__ . '/../../backend/src/includes/json_connect.php';

// 1. Obtener ID del producto de la URL
$productId = $_GET['id'] ?? null;

if (!$productId) {
    echo "<h1>Producte no especificat</h1>";
    exit;
}

// 2. Pedir datos del producto a la API
// TRUCO: Usamos ?id= en vez de /id. Esto devuelve un ARRAY con 1 resultado.
// Es más seguro porque a json-server le da igual si es número o texto.
$prodResponse = jsonRequest('GET', "/products?id=" . $productId);

// Como devuelve un array (lista), cogemos el primero [0]
$product = $prodResponse['data'][0] ?? null;

if (!$product) {
    echo "<h1>Producte no trobat (ID: " . htmlspecialchars($productId) . ")</h1>";
    exit;
}

// 3. Pedir comentarios de ESTE producto a la API
$commResponse = jsonRequest('GET', "/comments?product_id=" . $productId);
$comments = $commResponse['data'] ?? [];

// Título de la pestaña
$pageTitle = $product['nom'];
$customCss = '/frontend/css/styles_product.css';

// Recuperar mensajes de error/éxito de la sesión
$msgSuccess = $_SESSION['success_comment'] ?? null;
$msgError = $_SESSION['error_comment'] ?? null;
unset($_SESSION['success_comment'], $_SESSION['error_comment']);
?>

<?php include __DIR__ . '/partials/header.php'; ?>

<main style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    
    <div class="product-detail" style="display: flex; gap: 40px; margin-bottom: 40px;">
        <div class="product-image" style="flex: 1;">
             <img src="/<?= htmlspecialchars($product['img']) ?>" alt="<?= htmlspecialchars($product['nom']) ?>" style="width: 100%; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        </div>
        
        <div class="product-info" style="flex: 1;">
            <h1 style="font-size: 2.5rem; margin-bottom: 10px;"><?= htmlspecialchars($product['nom']) ?></h1>
            <p style="color: #666; font-size: 1.2rem;">SKU: <?= htmlspecialchars($product['sku']) ?></p>
            <p style="font-size: 2rem; color: #333; font-weight: bold; margin: 20px 0;"><?= htmlspecialchars($product['preu']) ?>€</p>
            
            <p class="description" style="line-height: 1.6; margin-bottom: 30px;">
                <?= htmlspecialchars($product['descripcio']) ?>
            </p>
            
            <p style="color: <?= $product['estoc'] > 0 ? 'green' : 'red' ?>">
                <strong>Estoc:</strong> <?= htmlspecialchars($product['estoc']) ?> unitats
            </p>

            <button style="padding: 15px 30px; background-color: black; color: white; border: none; cursor: pointer; font-size: 1.1rem; margin-top: 20px;">
                Afegir al Carret
            </button>
        </div>
    </div>

    <hr>

    <section class="comments-section" style="margin-top: 40px;">
        <h2>Opinions dels usuaris (<?= count($comments) ?>)</h2>

        <?php if ($msgSuccess): ?>
            <p style="color: green; background: #d4edda; padding: 10px; border-radius: 5px;"><?= htmlspecialchars($msgSuccess) ?></p>
        <?php endif; ?>
        <?php if ($msgError): ?>
            <p style="color: red; background: #f8d7da; padding: 10px; border-radius: 5px;"><?= htmlspecialchars($msgError) ?></p>
        <?php endif; ?>

        <div class="comments-list" style="margin-top: 20px;">
            <?php if (empty($comments)): ?>
                <p>Encara no hi ha comentaris. Sigues el primer en opinar!</p>
            <?php else: ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment-item" style="border-bottom: 1px solid #eee; padding: 15px 0;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <strong><?= htmlspecialchars($comment['username']) ?></strong>
                            <span style="color: #f39c12;">
                                <?= str_repeat('⭐', $comment['rating']) ?>
                            </span>
                        </div>
                        <p style="margin: 5px 0;"><?= htmlspecialchars($comment['comment']) ?></p>
                        <small style="color: #999;"><?= date('d/m/Y', strtotime($comment['date'])) ?></small>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php include __DIR__ . '/tmp_comment.php'; ?>

    </section>

</main>

<?php include __DIR__ . '/partials/footer.php'; ?>