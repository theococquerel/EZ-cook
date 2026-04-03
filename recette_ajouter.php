<?php
session_start();
require_once __DIR__ . '/Template.php';
require_once __DIR__ . '/Database.php';

// Vérifier si l'utilisateur est admin
if (!isset($_SESSION['login'])) {
    header("Location:index.php");
    exit();
}

$pdo = DataBase::getConnection();
$ingredients = DataBase::chargerTable($pdo,"Ingredients");
$tags = DataBase::chargerTable($pdo,"tag");

ob_start();
?>

<link rel="stylesheet" href="formadmin.css">

<div class="form-container">
    <h2>Ajouter une nouvelle recette</h2>
    
    <form action="recette_form.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titre">Titre de la recette *</label>
            <input type="text" id="titre" name="titre" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description *</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="photo">Photo de la recette</label>
            <input type="file" id="photo" name="photo">
        </div>
        
        <div class="form-group">
            <div class="section-title">Ingrédients *</div>
            <div class="checkbox-group">
                <?php foreach ($ingredients as $ingredient): ?>
                    <label>
                        <input type="checkbox" name="ingredients[]" value="<?=$ingredient['idIng'] ?>">
                        <?= htmlspecialchars($ingredient['nomIng']) ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="form-group">
            <div class="section-title">Tags (catégories)</div>
            <div class="checkbox-group">
                <?php foreach ($tags as $tag): ?>
                    <label>
                        <input type="checkbox" name="tags[]" value="<?= htmlspecialchars($tag['nomTag']) ?>">
                        <?= htmlspecialchars($tag['nomTag']) ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="form-actions">
            <a href="recettes.php" class="btn-cancel">Annuler</a>
            <button type="submit" class="btn-submit">Ajouter la recette</button>
        </div>
    </form>
</div>


<?php
$content = ob_get_clean();
Template::render($content);
?>
