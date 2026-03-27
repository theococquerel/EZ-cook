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
ob_start();
?>

<link rel="stylesheet" href="formadmin.css">

<div class="form-container">
    <h2>Ajouter un nouvel ingredient</h2>
    <form action="tag_form.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nomIng">Nom du tag*</label>
            <input type="text" id="titre" name="titre" required>
        </div>        
        <div class="form-actions">
            <a href="recettes.php" class="btn-cancel">Annuler</a>
            <button type="submit" class="btn-submit">Ajouter L'ingredient</button>
        </div>
    </form>
</div>


<?php
$content = ob_get_clean();
Template::render($content);
?>