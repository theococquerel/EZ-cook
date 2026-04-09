<?php
require_once __DIR__ . '/Template.php';
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Recette.php'; // N'oubliez pas d'inclure la classe Recette

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

$recettes = DataBase::chargerTable($pdo,"recette");
$ingredient = DataBase::chargerTable($pdo,"Ingredient");
$tags = DataBase::chargerTable($pdo,"tag");

$r = null;
foreach ($recettes as $tmp) {
    if ($tmp['id'] == $idr) {
        $listeIdIng = json_decode($tmp['listeIdIng'], true) ?? [];
        $listeTag = json_decode($tmp['listeTag'], true) ?? [];
        
        $r = new Recette(
            $tmp['id'],
            $tmp['titre'],
            $listeIdIng,
            $tmp['description'],
            $tmp['photo'],
            $listeTag
        );
        break;
    }
}

if (!$r) {
    $_SESSION['error'] = "recette non trouvé";
    header("Location: recettes.php");
    exit();
}

$recetteIngredient = $r->getListeIdIng();
$recetteTag = $r->getListTag();

ob_start();
?>

<div class="form-container">
    <h2>Modifier la recette</h2>
    
    <form action="recette_modifier_traitement.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idr" value="<?= $r->getId() ?>">
        
        <div class="form-group">
            <label for="nom">Nom de la recette *</label>
            <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($r->getTitre()) ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5" cols="50"><?= htmlspecialchars($r->getDescribe()) ?></textarea>
        </div>

        <div class="form-group">
            <div class="section-title">Ingrédients *</div>
            <div class="checkbox-group">
                <?php foreach ($ingredient as $ing): ?>
                    <label>
                        <input type="checkbox" 
                               name="ingredients[]" 
                               value="<?= $ing['idIng'] ?>"
                               <?= in_array($ing['idIng'], $recetteIngredient) ? 'checked' : '' ?>>
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
                        <input type="checkbox" 
                               name="tags[]" 
                               value="<?= htmlspecialchars($tag['nomTag']) ?>"
                               <?= in_array($tag['nomTag'], $recetteTag) ? 'checked' : '' ?>>
                        <?= htmlspecialchars($tag['nomTag']) ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="photo">Photo de la recette</label>
            <?php if (!empty($r->getPhoto())): ?>
                <div class="current-image">
                    <p>Image actuelle :</p>
                    <img src="<?= htmlspecialchars($r->getPhoto()) ?>" alt="Image actuelle" style="max-width: 200px;">
                </div>
            <?php endif; ?>
            <input type="file" id="photo" name="photo">
        </div>
        
        <div class="form-actions">
            <a href="recettes.php" class="btn-cancel">Annuler</a>
            <button type="submit" class="btn-submit">Modifier la recette</button>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
Template::render($content);
?>