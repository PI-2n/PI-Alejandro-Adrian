<?php
session_start();

require_once __DIR__ . '/../../backend/src/includes/json_connect.php';

$productId = $_GET['id'] ?? null;

if (!$productId) {
    echo "<h1>Producte no especificat</h1>";
    exit;
}

$prodResponse = jsonRequest('GET', "/products?id=" . $productId);

$product = $prodResponse['data'][0] ?? null;

if (!$product) {
    echo "<h1>Producte no trobat (ID: " . htmlspecialchars($productId) . ")</h1>";
    exit;
}

$commResponse = jsonRequest('GET', "/comments?product_id=" . $productId);
$comments = $commResponse['data'] ?? [];

$pageTitle = $product['nom'];
$customCss = '/frontend/css/product.css';

$msgSuccess = $_SESSION['success_comment'] ?? null;
$msgError = $_SESSION['error_comment'] ?? null;
unset($_SESSION['success_comment'], $_SESSION['error_comment']);
?>

<?php include __DIR__ . '/partials/header.php'; ?>

<div class="product-page-main">

    <main class="product-page-container">

        <div class="product-detail">
            <div class="product-image">
                <img src="/<?= htmlspecialchars($product['img']) ?>" alt="<?= htmlspecialchars($product['nom']) ?>">
            </div>

            <div class="product-info">
                <h1><?= htmlspecialchars($product['nom']) ?></h1>
                <p class="sku">SKU: <?= htmlspecialchars($product['sku']) ?></p>
                <p class="price"><?= htmlspecialchars($product['preu']) ?>€</p>

                <p class="description">
                    <?= htmlspecialchars($product['descripcio']) ?>
                </p>

                <div class="stock <?= $product['estoc'] > 0 ? 'in-stock' : 'out-of-stock' ?>">
                    <strong>Estoc:</strong> <?= htmlspecialchars($product['estoc']) ?> unitats
                </div>

                <div class="product-actions">
                    <button class="btn-add-cart">
                        Añadir al carrito
                    </button>

                    <button class="btn-fast-buy" title="Compra rápida">
                        <img src="/img/img_fast-buy.png" alt="Compra rápida">
                    </button>
                </div>
            </div>
        </div>

        <hr>

        <section class="comments-section">
            <h2>Comentarios</h2>

            <?php if ($msgSuccess): ?>
                <p class="msg-alert success"><?= htmlspecialchars($msgSuccess) ?></p>
            <?php endif; ?>
            <?php if ($msgError): ?>
                <p class="msg-alert error"><?= htmlspecialchars($msgError) ?></p>
            <?php endif; ?>

            <div class="comments-list">
                <?php if (empty($comments)): ?>
                    <p>Todavía no hay comentarios de este producto.</p>
                <?php else: ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment-item">
                            <div class="comment-header">
                                <strong><?= htmlspecialchars($comment['username']) ?></strong>
                                <span class="rating">
                                    ⭐ <?= $comment['rating'] ?>
                                </span>
                            </div>
                            <p><?= htmlspecialchars($comment['comment']) ?></p>
                            <small class="comment-date"><?= date('d/m/Y', strtotime($comment['date'])) ?></small>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php include __DIR__ . '/tmp_comment.php'; ?>

        </section>

    </main>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>