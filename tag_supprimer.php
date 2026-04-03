<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Tag.php';
$nom=$_GET["id"];
$pdo =DataBase::getConnection();


$result=Database::SupprimerTag($nom,$pdo);



if ($result){
    header("Location:tags.php");
    exit();
}
else {
    $_SESSION['error'] = "Erreur lors de la suppression du tag";
    header("Location:tags.php");
    exit();
    }