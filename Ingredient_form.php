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
$ingredients=DataBase::chargerTable($pdo,"Ingredient");
$idIng=0;
foreach($ingredients as $i){
    if ($i["idIng"]>$idIng){
        $idIng=$i["idIng"];
    }
}
$idIng++;

// Récupération des données du formulaire
/*$titre = trim($_POST['titre'] ?? '');
$photoName = $_FILES['photo']['name'];
$errors = [];*/

$titre = trim($_POST['titre'] ?? '');
$photoName = '';
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    // Le dossier existe déjà, on l'utilise directement
    $uploadDir = 'imagesingredient/';
    
    // Garder le nom d'origine du fichier
    $photoName = $uploadDir . basename($_FILES['photo']['name']);
    
    // Déplacer le fichier uploadé vers le dossier imagesingredient/
    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoName)) {
        $_SESSION['error'] = "Erreur lors de l'upload de l'image.";
        header("Location: ingredient_ajouter.php");
        exit();
    }
}




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