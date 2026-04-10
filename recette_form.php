<?php
session_start();
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Recette.php';
$pdo = DataBase::getConnection();
if (!isset($_SESSION['login'])) {
    header("Location:index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: recette_ajouter.php");
    exit();
}
$recettes=DataBase::chargerTable($pdo, "Recette");
$id=0;
foreach($recettes as $i){
    if ($i["id"]>$id){
        $id=$i["id"];
    }
}
$id++;

// Récupération des données du formulaire
$titre = trim($_POST['titre'] ?? '');
$description = trim($_POST['description'] ?? '');
$ingredients = $_POST['ingredients'] ?? [];
$tags = $_POST['tags'] ?? [];

// Gestion de l'upload de l'image
$photoName = $_FILES['photo']['name'];
// Validation des données
$errors = [];

if (empty($titre)) {
    $errors[] = "Le titre est obligatoire.";
}

if (empty($description)) {
    $errors[] = "La description est obligatoire.";
}

if (empty($ingredients)) {
    $errors[] = "Veuillez sélectionner au moins un ingrédient.";
}
if (!empty($errors)) {
    $_SESSION['error'] = implode('<br>', $errors);
    header("Location: recette_ajouter.php");
    exit();
}

// Création de l'objet Recette
$recette = new Recette($id,$titre, $ingredients, $description, $photoName, $tags);

// Connexion à la BDD et ajout
try {
    $pdo = DataBase::getConnection();
    $result = DataBase::ajouterRecette($recette, $pdo);
    
    if ($result) {
        $_SESSION['message'] = "Recette \"" . $recette->getTitre() . "\" ajoutée avec succès !";
        header("Location: recettes.php");
        exit();
    } else {
        $_SESSION['error'] = "Erreur lors de l'ajout de la recette.";
        header("Location: recette_ajouter.php");
        exit();
    }
} catch (Exception $e) {
    $_SESSION['error'] = "Erreur technique : " . $e->getMessage();
    header("Location: recette_ajouter.php");
    exit();
}
?>