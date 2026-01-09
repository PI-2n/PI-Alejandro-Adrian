<?php
?>

<div class="comment-form-container" style="margin-top: 30px; padding: 20px; background-color: #f9f9f9; border-radius: 8px;">
    <h3>Deja tu comentario</h3>

    <?php if (isset($_SESSION['user_id'])): ?>
        
        <form action="/backend/src/db/comment.php" method="POST">
            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">

            <label for="rating">Puntuación:</label>
            <select name="rating" id="rating" required style="padding: 5px; margin-bottom: 10px;">
                <option value="5">⭐ 5 </option>
                <option value="4">⭐ 4</option>
                <option value="3">⭐ 3</option>
                <option value="2">⭐ 2</option>
                <option value="1">⭐ 1</option>
            </select>
            <br>

            <label for="comment">Comentario:</label><br>
            <textarea name="comment" id="comment" rows="4" style="width: 100%; max-width: 600px; padding: 10px;" placeholder="¿Qué te ha parecido este producto?" required></textarea>
            <br><br>

            <button type="submit" class="search-btn" style="width: auto; padding: 10px 20px; background-color: #333; color: white; cursor: pointer;">
                Publicar Comentario
            </button>
        </form>

    <?php else: ?>
        <p>
            <a href="/frontend/templates/tmp_login.php" style="color: #007bff; text-decoration: underline;">Inicia sesión</a> 
            para dejar un comentario.
        </p>
    <?php endif; ?>
</div>