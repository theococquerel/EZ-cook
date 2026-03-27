<?php
session_start();
require_once __DIR__.DIRECTORY_SEPARATOR."Template.php";
require_once __DIR__.DIRECTORY_SEPARATOR."DataBase.php";
ob_start()?>
<div id="LogResult">
    <?php
    if (isset($_SESSION['error'])){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    else if (isset($_SESSION['login'])):?>
        <p style="color:red">Authentification reussi<br>Mode Admin Active</p>
    <?php endif ?>
</div>
<?php
$con=DataBase::getConnection();
$ing=DataBase::chargerIngredients($con);
$result=DataBase::chargerRecettes($con);
?>
<table id="tableRecettes">
    <?php foreach ($result as $recette): ?>
        <td>
            <ul class="recettes-list">
                <li><?= $recette['id'] ?> - <?= $recette['titre'] ?></li>
                <li> <img src="<?= $recette['photo'] ?>" alt="Photo crepes" width="200px"> </li>
                <li> <?= $recette['description'] ?> </li>
            </ul>
        </td>
    <?php endforeach;?>
</table>
<?php
$content=ob_get_clean();
 Template::render($content)?>