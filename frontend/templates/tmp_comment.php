<?php
// Este archivo es un "partial", se incluye dentro de tmp_product.php
// Asumimos que $product['id'] está disponible desde la página padre.
?>

<div class="comment-form-container" style="margin-top: 30px; padding: 20px; background-color: #f9f9f9; border-radius: 8px;">
    <h3>Deixa la teva opinió</h3>

    <?php if (isset($_SESSION['user_id'])): ?>
        
        <form action="/backend/src/db/comment.php" method="POST">
            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">

            <label for="rating">Valoració:</label>
            <select name="rating" id="rating" required style="padding: 5px; margin-bottom: 10px;">
                <option value="5">⭐⭐⭐⭐⭐ (Excellent)</option>
                <option value="4">⭐⭐⭐⭐ (Molt bo)</option>
                <option value="3">⭐⭐⭐ (Bo)</option>
                <option value="2">⭐⭐ (Regular)</option>
                <option value="1">⭐ (Dolent)</option>
            </select>
            <br>

            <label for="comment">El teu comentari:</label><br>
            <textarea name="comment" id="comment" rows="4" style="width: 100%; max-width: 600px; padding: 10px;" placeholder="Què t'ha semblat aquest producte?" required></textarea>
            <br><br>

            <button type="submit" class="search-btn" style="width: auto; padding: 10px 20px; background-color: #333; color: white; cursor: pointer;">
                Publicar Comentari
            </button>
        </form>

    <?php else: ?>
        <p>
            <a href="/frontend/templates/tmp_login.php" style="color: #007bff; text-decoration: underline;">Inicia sessió</a> 
            per deixar un comentari.
        </p>
    <?php endif; ?>
</div>