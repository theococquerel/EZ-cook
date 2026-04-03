<?php
session_start();
require_once __DIR__ . '/Template.php';
require_once __DIR__ . '/Database.php';

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

$pdo = DataBase::getConnection();
$idIng = $_GET['id'] ?? null;

if (!$idIng) {
    header("Location: ingredients.php");
    exit();
}

// Récupérer l'ingrédient à modifier
$ingredients = DataBase::chargerIngredients($pdo);
$ingredient = null;

foreach ($ingredients as $ing) {
    if ($ing['idIng'] == $idIng) {
        $ingredient = $ing;
        break;
    }
}

if (!$ingredient) {
    $_SESSION['error'] = "Ingrédient non trouvé";
    header("Location: ingredient_gestion.php");
    exit();
}

ob_start();
?>


<div class="form-container">
    <h2>Modifier l'ingrédient</h2>
    
    <form action="ingredient_modifier_traitement.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idIng" value="<?= $ingredient['idIng'] ?>">
        
        <div class="form-group">
            <label for="nom">Nom de l'ingrédient *</label>
            <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($ingredient['nomIng']) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="photo">Photo de l'ingrédient</label>
            <?php if (!empty($ingredient['photoIng'])): ?>
                <div class="current-image">
                    <p>Image actuelle :</p>
                    <img src="<?= htmlspecialchars($ingredient['photoIng']) ?>" alt="Image actuelle" style="max-width: 200px;">
                </div>
            <?php endif; ?>
            <input type="file" id="photo" name="photo">
        </div>
        
        <div class="form-actions">
            <a href="ingredients.php" class="btn-cancel">Annuler</a>
            <button type="submit" class="btn-submit">Modifier l'ingrédient</button>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
Template::render($content);
?>