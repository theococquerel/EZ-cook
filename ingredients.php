<?php
require_once __DIR__ . '/Template.php';
require_once __DIR__ . '/DataBase.php';


if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

ob_start();
$pdo=DataBase::getConnection();
$ing=DataBase::chargerIngredients($pdo);?>
<div class="table-container">
<h2>Gestion des ingredients</h2>
<a href="ingredient_ajouter.php">Ajouter un ingredient</a>
<table border="1" cellpadding="10">
    <thead>   
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
    </thead> 
<tbody>
    <?php foreach($ing as $i):?>
    <tr>
        <td><?= $i['idIng']?></td>
        <td><?= htmlspecialchars($i['nomIng'])?></td>
        <td>
        <a href="ingredient_modifier.php?id=<?=$i['idIng']?>">Modifier</a>
        <a href="ingredient_supprimer.php?id=<?=$i['idIng']?>">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>
            </div>
            

<?php
 $content=ob_get_clean();
Template::render($content);?>