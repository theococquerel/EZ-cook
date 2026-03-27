<?php
require_once __DIR__ .'/Template.php';
require_once __DIR__ .'/Database.php';
require_once __DIR__ .'/Recette.php';

$pdo = DataBase::getConnection();
$ingredients = DataBase::chargerIngredients($pdo);
$tags = DataBase::chargerTags($pdo);

echo "Formulaire d'ajout de recette <br>";

$recette = new Recette(
    $id = null, //ID de la recette
    $titre = "Nouvelle recette", // titre de la recette
    $listeIng = [1, 2, 3], // IDs des ingrédients
    $describe = "Description de la recette", // describe
    $photo = "photo.jpg",
    $tags = ["Tag1", "Tag2"] // Noms des tags
);

$ingr = new Ingredient(
    $id = 100,
    $nomIng = "Levure",
    $imageIng = "levure.jpg"
)

DataBase::ajouterRecette($recette,$pdo);
DataBase::ajouterIng($ingr, $pdo);
