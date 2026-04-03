<?php
include "Recette.php";
include "Ingredient.php";
include "Tag.php";

class DataBase{
    // Méthode pour se connecter à la BDD
    public static function getConnection(): PDO{
        // Informations sur la BDD et le serveur qui la contient
        $db_name = "BddRecettes" ; // Nom de la base de données (pré-existante)
        $db_host = "127.0.0.1" ; // Si le serveur MySQL est sur la machine locale
        $db_port = "3306" ; //lucien = "3306" et yann et theo = "3307"

        $db_user = "root" ; 
        $db_pwd = "" ;

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
        return $pdo;
    }
    // Méthode pour charger tous les ingrédients de la BDD
    public static function chargerIngredients($pdo): array{
        $sqlAllIng = "SELECT * FROM Ingredient" ;
        $statement = $pdo->prepare($sqlAllIng) ;
        $statement->execute() or die(var_dump($statement->errorInfo())) ;
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // Méthode pour charger toutes les recettes de la BDD
    public static function chargerRecettes($pdo): array{
        $sqlAllRecettes = "SELECT * FROM Recette" ;
        $statement = $pdo->prepare($sqlAllRecettes) ;
        $statement->execute() or die(var_dump($statement->errorInfo())) ;
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function chargerTags($pdo): array{
        $sqlAlltag = "SELECT * FROM tag" ;
        $statement = $pdo->prepare($sqlAlltag) ;
        $statement->execute() or die(var_dump($statement->errorInfo())) ;
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //public static function ajoutertag()
    public static function ajouterIng(Ingredient $ing, $pdo):bool{
        $sqlRequette = "INSERT INTO Ingredient (idIng, nomIng,photoIng) VALUES (".$ing->getId().", '".$ing->getNom()."', '".$ing->getImage()."')";
        echo $sqlRequette . "<br>";
        $statement = $pdo->prepare($sqlRequette);
        try {
            $statement->execute() or die(var_dump($statement->errorInfo()));
        } catch (\Exception $ex) {
            // Arrêt de l'exécution du script PHP
            die("Erreur : " . $ex->getMessage()) ;
            return false;
        }
        echo "Ingredient ajouté !";
        return true;
    }

    public static function ajouterRecette(Recette $rec, $pdo){
        $id = $rec->getId();
        $titre = $rec->getTitre();
        $listIng = json_encode($rec->getListeIdIng());
        $describe = $rec->getDescribe();
        $photo = $rec->getPhoto();
        $listTag = json_encode($rec->getListTag());
        $sqlRequette = "INSERT INTO Recette (id, titre, listeIdIng, description, photo, listeTag) VALUES ('".$id."', '".$titre."', '".$listIng."', '".$describe."', '".$photo."', '".$listTag."')";
        echo $sqlRequette . "<br> <br>";
        $statement = $pdo->prepare($sqlRequette);
        try {
            $statement->execute() or die(var_dump($statement->errorInfo()));
        } catch (\Exception $ex) {
            // Arrêt de l'exécution du script PHP
            die("Erreur : " . $ex->getMessage()) ;
        }
        echo "Recette ajoutée !";
    }

    //public static function ModifierRecette();
    //public static function ModifierTag()
    //public static function ModifierIng()
    //public static function SupprimerRecette()
    //public static function SupprimerIng()
    //public static function SupprimerTag()


    
} 
?>