<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Ingredient.php';

//if (!isset($_SESSION['login'])) {
    //header("Location:index.php");
    //exit();
//}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ingredient_ajouter.php");
    exit();
}

$pdo = DataBase::getConnection();
$ingredients=DataBase::chargerIngredients($pdo);
$idIng=0;
foreach($ingredients as $i){
    if ($i["idIng"]>$idIng){
        $idIng=$i["idIng"];
    }
}
$idIng++;

// Récupération des données du formulaire
$titre = trim($_POST['titre'] ?? '');
$photoName = $_FILES['photo']['name'];
$errors = [];

$Ing = new Ingredient($idIng,$titre,$photoName);

$result = DataBase::ajouterIng($Ing,$pdo);
    
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