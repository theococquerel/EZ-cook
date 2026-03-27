<?php require_once __DIR__.DIRECTORY_SEPARATOR."Template.php";
include_once __DIR__.DIRECTORY_SEPARATOR."DataBase.php";

$pdo = DataBase::getConnection();

// ON COMMENCE A FAIRE DES REQUETES SQL

$result = DataBase::chargerIngredients($pdo);
/*
    echo "<pre>";
    var_dump($result);
    echo "</pre>";
*/
// ON COMMENCE LE HTML
?>
<br><br>
<h3>Liste des ingrédients</h3>
<ul class="ingredients-list">
<!--Affichage du champ 'nomIng' des objets récupérés -->
<?php foreach ($result as $ingre): ?>
    <li><?= $ingre['idIng'] ?> - <?= $ingre['nomIng'] ?> - <img src="<?= $ingre['photoIng'] ?>" alt="Photo <?= $ingre['nomIng'] ?>"> </li>
<?php endforeach;?>
</ul>

<h3> Liste des Recettes </h3>
<?php

$result = DataBase::chargerRecettes($pdo);
/*
echo "<pre>";
var_dump($result);
echo "</pre>";
*/
?>
<table id="tableRecettes">
    <?php foreach ($result as $recette): ?>
        <td>
            <ul class="recettes-list">
                <li><?= $recette['id'] ?> - <?= $recette['titre'] ?></li>
                <li> <img src="<?= $recette['photo'] ?>" alt="Photo <?= $recette['titre'] ?>" width="200px"> </li>
                <li> <?= $recette['description'] ?> </li>
            </ul>
        </td>
    <?php endforeach;?>
</table>

<?php $content=ob_get_clean(); Template::render($content) ?>