<?php
session_start();
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Ingredient.php';

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ingredient_gestion.php");
    exit();
}

$pdo = DataBase::getConnection();
$idIng = $_POST['idIng'] ?? null;
$nom = trim($_POST['nom'] ?? '');

if (!$idIng || empty($nom)) {
    $_SESSION['error'] = "Tous les champs sont obligatoires";
    header("Location: ingredient_modifier.php?id=" . $idIng);
    exit();
}

// Gestion de la photo
$photoName = null;

// Récupérer l'ancienne photo si nécessaire
$ingredients = DataBase::chargerIngredients($pdo);
$anciennePhoto = '';
foreach ($ingredients as $ing) {
    if ($ing['idIng'] == $idIng) {
        $anciennePhoto = $ing['photoIng'];
        break;
    }
}

$photoName = $anciennePhoto;


// Créer l'objet Ingredient
$ingredient = new Ingredient($idIng, $nom, $photoName);

// Modifier dans la base de données
$result = DataBase::ModifierIng($ingredient, $idIng, $pdo);

if ($result) {
    $_SESSION['message'] = "Ingrédient '$nom' modifié avec succès !";
    header("Location: ingredients.php");
    exit();
} else {
    $_SESSION['error'] = "Erreur lors de la modification de l'ingrédient";
    header("Location: ingredient_modifier.php?id=" . $idIng);
    exit();
}
?>