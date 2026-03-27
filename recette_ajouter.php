<?php
require_once __DIR__ .'/Template.php';
require_once __DIR__ .'/Database.php';
require_once __DIR__ .'/Recette.php';

$pdo = DataBase::getConnection();
$ingredients = DataBase::chargerIngredients($pdo);
$tags = DataBase::chargerTags($pdo);

echo "Formulaire d'ajout de recette <br>";

$recette = new Recette(
    "101", //ID de la recette
    "Nouvelle recette",
    "Description de la recette",
    "photo.jpg",
    [1, 2], // IDs des ingrédients
    ["Tag1", "Tag2"] // Noms des tags
);

DataBase::ajouterRecette($recette,$pdo);