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

<?php
/*
SqlDECLARE @json NVARCHAR(MAX) = '["pomme", "banane", "orange"]';
DECLARE @val NVARCHAR(50) = 'banane';

-- Vérifier si la valeur est dans le tableau JSON
IF EXISTS (
    SELECT 1
    FROM OPENJSON(@json) 
    WHERE value = @val
)
    PRINT 'Valeur trouvée';
ELSE
    PRINT 'Valeur absente';

Explication :

OPENJSON transforme le tableau JSON en table avec une colonne value.
EXISTS permet de vérifier la présence de la valeur.


2. MySQL (>= 5.7)
MySQL propose la fonction JSON_CONTAINS pour vérifier si un élément est présent dans un tableau JSON.
Exemple :
SqlSET @json = '["pomme", "banane", "orange"]';
SET @val = '"banane"'; -- Attention : valeur JSON valide (avec guillemets)

SELECT 
    JSON_CONTAINS(@json, @val) AS est_present;

Résultat :

1 → valeur trouvée
0 → valeur absente


3. PostgreSQL
PostgreSQL utilise les opérateurs JSON/JSONB (@>) pour vérifier la présence.
Exemple :
SqlSELECT '["pomme", "banane", "orange"]'::jsonb @> '["banane"]'::jsonb AS est_present;


 Bonnes pratiques :

Toujours stocker les données JSON dans un type natif (JSON ou JSONB) si possible.
Éviter de parcourir du JSON texte brut dans de grosses tables : privilégier la normalisation ou les index JSON.
*/ ?>
