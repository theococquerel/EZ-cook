<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Tag.php';
$nom=$_GET["id"];
$pdo =DataBase::getConnection();
$t=new Tag($nom);

$result=Database::SupprimerTag($t,$pdo);



if ($result){
    header("Location:tags.php");
    exit();
}
else {
    $_SESSION['error'] = "Erreur lors de la suppression du tag";
    header("Location:ingredient_ajouter.php");
    exit();
    }