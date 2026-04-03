<?php

require_once __DIR__ . '/Template.php';
require_once __DIR__ . '/Database.php';

$pdo = DataBase::getConnection();
ob_start();
?>



<div class="form-container">
    <h2>Modifier un ingredient</h2>
    <form action="ingredient_form.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nomIng">Nom de l'ingredient *</label>
            <input type="text" id="titre" name="titre" required>
        </div>
        <div class="form-group">
            <label for="photo">Photo Ing</label>
            <input type="file" id="photo" name="photo">
        </div>        
        <div class="form-actions">
            <a href="Ingredient_ajout.php" class="btn-cancel">Annuler</a>
            <button type="submit" class="btn-submit">Ajouter L'ingredient</button>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
Template::render($content);
?>