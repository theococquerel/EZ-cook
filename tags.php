<?php
require_once __DIR__ . '/Template.php';
require_once __DIR__ . '/DataBase.php';

if (!isset($_SESSION['login'])) {
    header("Location:index.php");
    exit();
}


ob_start();
$pdo=DataBase::getConnection();
$tags=DataBase::chargerTable($pdo,"tag");?>
<div class="table-container">
<h2>Gestion des Tag</h2>
<a href="tags_ajout.php">Ajouter un tag</a>
<table border="1" cellpadding="10">
    <thead>   
        <tr>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
    </thead> 
<tbody>
    <?php foreach($tags as $t):?>
    <tr>
        <td><?= htmlspecialchars($t['nomTag'])?></td>
        <td>
        <a href="tag_supprimer.php?id=<?=$t['nomTag']?>">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>
    </div>


<?php $content=ob_get_clean();
Template::render($content);