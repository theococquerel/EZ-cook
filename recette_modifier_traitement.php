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
$idr = $_POST['id'] ?? null;
$nom = trim($_POST['nom'] ?? '');

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


// Créer l'objet Ingredient
$res = new Recette($idr, $nom, $photoName);

// Modifier dans la base de données
$result = DataBase::ModifierRecette($res, $idr, $pdo);

if ($result) {
    $_SESSION['message'] = "recette '$nom' modifié avec succès !";
    header("Location: recette.php");
    exit();
} else {
    $_SESSION['error'] = "Erreur lors de la modification de la recette";
    header("Location: recette_modifier.php?id=" . $idIng);
    exit();
}
?>