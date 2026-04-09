<?php
require_once __DIR__ . '/Database.php';
$id = $_GET["id"] ?? null;
if (!$id) {
    header("Location: recettes.php");
    exit();
}

$pdo =DataBase::getConnection();
$result =Database::SupprimerRecette($id,$pdo);


if ($result){
    header("Location:recettes.php");
    exit();
}
else {
    $_SESSION['error'] = "Erreur lors de la suppression de la recette.";
    header("Location:recettes.php");
    exit();
    }