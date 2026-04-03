<?php
session_start();
require_once __DIR__ . '/Template.php';
require_once __DIR__ . '/Database.php';

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

$pdo = DataBase::getConnection();
$idr = $_GET['id'] ?? null;

if (!$idr) {
    header("Location: recettes.php");
    exit();
}

// Récupérer l'ingrédient à modifier
$recettes = DataBase::chargerTable($pdo,"recette");
$ingredient=DataBase::chargerTable($pdo,"Ingredient");
$tags=DataBase::chargerTable($pdo,"tag");
$r = null;

foreach ($recettes as $tmp) {
    if ($tmp['id'] == $idr) {
        $r = $tmp;
        break;
    }
}

if (!$r) {
    $_SESSION['error'] = "recette non trouvé";
    header("Location: recettes.php");
    exit();
}

ob_start();
?>


<div class="form-container">
    <h2>Modifier la recette</h2>
    
    <form action="recette_modifier_traitement.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idr" value="<?= $r['id'] ?>">
        
        <div class="form-group">
            <label for="nom">Nom de la recette *</label>
            <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($r['titre']) ?>" required>
        </div>


        <div class="form-group">
            <div class="section-title">Ingrédients *</div>
            <div class="checkbox-group">
                <?php foreach ($ingredient as $ing): ?>
                    <label>
                        <input type="checkbox" name="ingredients[]" value="<?=$ing['idIng'] ?>">
                        <?= htmlspecialchars($ing['nomIng']) ?>
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

        <div class="form-group">
            <label for="photo">Photo de la recette</label>
            <?php if (!empty($r['photo'])): ?>
                <div class="current-image">
                    <p>Image actuelle :</p>
                    <img src="<?= htmlspecialchars($r['photo']) ?>" alt="Image actuelle" style="max-width: 200px;">
                </div>
            <?php endif; ?>
            <input type="file" id="photo" name="photo">
        </div>
        
        <div class="form-actions">
            <a href="recettes.php" class="btn-cancel">Annuler</a>
            <button type="submit" class="btn-submit">Modifier l'ingrédient</button>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
Template::render($content);
?>