<?php
require_once __DIR__ .'/Template.php';
require_once __DIR__ .'/Database.php';

/*if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit();
}*/

$pdo = DataBase::getConnection();
$ingredients = DataBase::chargerIngredients($pdo);
$tags = DataBase::chargerTags($pdo);


DataBase::ajouter();

