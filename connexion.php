<?php

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
echo "Connexion OK<br>" ;

$sql = "SELECT * FROM Ingredient" ;
$statement = $pdo->prepare($sql) ;
$statement->execute() or die(var_dump($statement->errorInfo())) ;

$result = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<h3>Liste des ingrédients</h3>
<ul>
<!--Affichage du champ 'nomIng' des objets récupérés -->
<?php foreach ($result as $ingre): ?>
    <li><?= $ingre['idIng'] ?> - <?= $ingre['nomIng'] ?></li>
<?php endforeach;?>
</ul>