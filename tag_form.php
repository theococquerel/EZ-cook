<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Tag.php';

//if (!isset($_SESSION['login'])) {
    //header("Location:index.php");
    //exit();
//}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ingredient_ajouter.php");
    exit();
}


$pdo = DataBase::getConnection();

// Récupération des données du formulaire
$titre = trim($_POST['titre'] ?? '');

$Tag = new Tag($titre);

$result = DataBase::ajoutertag($Tag,$pdo);
    
    if ($result) {
        $_SESSION['message'] = "Ingredient \"" . $Ing->getNom() . "\" ajoutée avec succès !";
        header("Location:ingredients.php");
        exit();
    } else {
        $_SESSION['error'] = "Erreur lors de l'ajout de l'ingredient.";
        header("Location:ingredient_ajouter.php");
        exit();
    }
?>