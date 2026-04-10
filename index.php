<!-- template de la page d'accueil (header et footer inclus) -->
<?php
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
        <p style="color:red">Authentification réussie<br>Mode Admin Activé.</p>
    <?php endif ?>
</div>
<?php
$con=DataBase::getConnection(); // PDO $con est la connexion à la base de données
$ing=DataBase::chargerTable($con, "Ingredient");
$result=DataBase::chargerTable($con, "Recette");
?>
<?php require_once "accueil.php"?>


<?php
$content=ob_get_clean();
 Template::render($content)?>