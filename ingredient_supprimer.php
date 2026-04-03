<?php
require_once __DIR__ . '/Database.php';
$id=$_GET["id"];
$pdo =DataBase::getConnection();
$result =Database::SupprimerIng($id,$pdo);



if ($result){
    header("Location:ingredients.php");
    exit();
}
else {
    $_SESSION['error'] = "Erreur lors de l'ajout de l'ingredient.";
    header("Location:ingredient_ajouter.php");
    exit();
    }