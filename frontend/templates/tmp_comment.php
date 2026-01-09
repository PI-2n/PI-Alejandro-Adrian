<?php
?>

<div class="comment-form-container">
    <h3>Deja tu comentario</h3>

    <?php if (isset($_SESSION['user_id'])): ?>
        
        <form action="/backend/src/db/comment.php" method="POST">
            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">

            <div class="form-group">
                <label for="rating">Puntuación:</label>
                <select name="rating" id="rating" required>
                    <option value="5">⭐ 5 </option>
                    <option value="4">⭐ 4</option>
                    <option value="3">⭐ 3</option>
                    <option value="2">⭐ 2</option>
                    <option value="1">⭐ 1</option>
                </select>
            </div>

            <div class="form-group">
                <label for="comment">Comentario:</label>
                <textarea name="comment" id="comment" rows="4" placeholder="¿Qué te ha parecido este producto?" required></textarea>
            </div>

            <button type="submit" class="btn-submit">
                Publicar Comentario
            </button>
        </form>

    <?php else: ?>
        <p>
            <a href="/frontend/templates/tmp_login.php" style="color: #dd7710ec; text-decoration: underline;">Inicia sesión</a> 
            para dejar un comentario.
        </p>
    <?php endif; ?>
</div>