<?php
session_start();
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Ingredient.php';

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: recettes.php");
    exit();
}

$pdo = DataBase::getConnection();
$idr = $_POST['idr'] ?? null;
$nom = trim($_POST['nom'] ?? '');
$description = trim($_POST['description'] ?? '');
$ingredients = $_POST['ingredients'] ?? [];
$tags = $_POST['tags'] ?? [];

if (!$idr || empty($nom)) {
    $_SESSION['error'] = "Tous les champs sont obligatoires";
    header("Location: recette_modifier.php?id=" . $idIng);
    exit();
}

// Gestion de la photo
$photoName = null;

// Récupérer l'ancienne photo si nécessaire
$recette = DataBase::chargerTable($pdo,"recette");
$anciennePhoto = '';
foreach ($recette as $tmp) {
    if ($tmp['id'] == $idr) {
        $anciennePhoto = $tmp['photo'];
        break;
    }
}

$photoName = $anciennePhoto;
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'imagesrecettes/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $photoName = $uploadDir . basename($_FILES['photo']['name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], $photoName);
}


// Créer l'objet Ingredient
$res = new Recette($idr, $nom,$ingredients,$description,$photoName,$tags);

// Modifier dans la base de données
$result = DataBase::ModifierRecette($res, $idr, $pdo);

if ($result) {
    $_SESSION['message'] = "recette '$nom' modifié avec succès !";
    header("Location: recettes.php");
    exit();
} else {
    $_SESSION['error'] = "Erreur lors de la modification de la recette";
    header("Location: recette_modifier.php?id=" . $idIng);
    exit();
}
?>