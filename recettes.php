<?php
require_once __DIR__ . '/Template.php';
require_once __DIR__ . '/DataBase.php';


if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

ob_start();
$pdo=DataBase::getConnection();
$recettes=DataBase::chargerTable($pdo,"recette");?>
<div class="table-container">
<h2>Gestion des recettes</h2>
<a href="recette_ajouter.php">Ajouter une recette</a>
<table border="1" cellpadding="10">
    <thead>   
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Actions</th>
        </tr>
    </thead> 
<tbody>
    <?php foreach($recettes as $r):?>
    <tr>
        <td><?= $r['id']?></td>
        <td><?= htmlspecialchars($r['titre'])?></td>
        <td>
        <a href="recette_modifier.php?id=<?=$r['id']?>">Modifier</a>
        <a href="recette_supprimer.php?id=<?=$r['id']?>">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>
    </div>

<?php $content=ob_get_clean();
Template::render($content);