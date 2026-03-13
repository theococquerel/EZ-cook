<?php

$db_name = "gamesdb" ; // Nom 
$db_host = "127.0.0.1" ; // Si le serveur MySQL est sur la machine locale
$db_port = "3306" ; // Port par défaut de MySQL

// Informations d'authentification de votre script PHP
$db_user = "root" ; // Utilisateur par défaut de MySQL (... à changer)
$db_pwd = "root" ;  // Mot de passe par défaut pour l'utilisateur root (.. à changer !!!)
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