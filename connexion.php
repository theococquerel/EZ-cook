<?php require_once __DIR__.DIRECTORY_SEPARATOR."Template.php";

// Informations sur la BDD et le serveur qui la contient
$db_name = "BddRecettes" ; // Nom de la base de données (pré-existante)
$db_host = "127.0.0.1" ; // Si le serveur MySQL est sur la machine locale
$db_port = "3306" ; // Port par défaut de MySQL

// Informations d'authentification de votre script PHP
$db_user = "root" ; // Utilisateur par défaut de MySQL (... à changer)
$db_pwd = "" ;  // Mot de passe par défaut pour l'utilisateur root (.. à changer !!!)

// Connexion à la BDD
try{
    // Agrégation des informations de connexion dans une chaine DSN (Data Source Name)
    $dsn = 'mysql:dbname=' . $db_name . ';host='. $db_host. ';port=' . $db_port;

    // Connexion et récupération de l'objet connecté
    $pdo = new PDO($dsn, $db_user, $db_pwd);
}

// Récupération d'une éventuelle erreur
catch (\Exception $ex){
    // Arrêt de l'exécution du script PHP
    die("Erreur : " . $ex->getMessage()) ;
}

// Si pas d'erreur : poursuite de l'exécution
// echo "Connexion OK<br>" ;

// ON COMMENCE A FAIRE DES REQUETES SQL

$sqlAllIng = "SELECT * FROM Ingredient" ;
$statement = $pdo->prepare($sqlAllIng) ;
$statement->execute() or die(var_dump($statement->errorInfo())) ;

$result = $statement->fetchAll(PDO::FETCH_ASSOC);
// ON COMMENCE LE HTML
?>
<br><br><br><br>
<h3>Liste des ingrédients</h3>
<ul>
<!--Affichage du champ 'nomIng' des objets récupérés -->
<?php foreach ($result as $ingre): ?>
    <li><?= $ingre['idIng'] ?> - <?= $ingre['nomIng'] ?> - <?= $ingre['photoIng'] ?></li>
<?php endforeach;?>
</ul>

<h3> Liste des Recettes </h3>
<?php
$sqlAllRecettes = "SELECT * FROM Recette" ;
$statement = $pdo->prepare($sqlAllRecettes) ;
$statement->execute() or die(var_dump($statement->errorInfo())) ;
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

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

<?php $content=ob_get_clean(); Template::render($content) ?>