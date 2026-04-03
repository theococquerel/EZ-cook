<?php
require_once __DIR__ . '/Template.php';
require_once __DIR__ . '/DataBase.php';


if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

ob_start();
$pdo=DataBase::getConnection();
$ing=DataBase::chargerTable($pdo, "ingredient");?>
<?php if(isset($_SESSION['message'])): ?>
    <div class="success-message"><?= $_SESSION['message'] ?></div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php if(isset($_SESSION['error'])): ?>
    <div class="error-message"><?= $_SESSION['error'] ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
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
var_dump($_SESSION);
 $content=ob_get_clean();
Template::render($content);?>