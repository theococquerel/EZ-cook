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

    public static function ajoutertag(Tag $tag, $pdo):bool{

        $array = DataBase::chargerTags($pdo);

        foreach($array as $e){
            if($e["nomTag"] == $tag->getNom()){
                return true;
            }
        }

        $sqlRequette = "INSERT INTO tag (nomTag) VALUES (". $tag->getNom() .")";

        $statement = $pdo->prepare($sqlRequette);

        try{
            $statement->execute() or die(var_dump($statement->errorInfo()));
        }
        catch(\Exception $ex){
            die("Erreur ajout Tag : " . $ex->getMessage()) ;
            return false;
        }
        echo "Tag ajouté";
        return true;
    }

    public static function ajouterIng(Ingredient $ing, $pdo):bool{

        $array = DataBase::chargerIngredients($pdo);

        foreach($array as $e){
            if($e["nomIng"] === $ing->getNom()){
                return true;
            }
        }

        $sqlRequette = "INSERT INTO Ingredient (idIng, nomIng,photoIng) VALUES (".$ing->getId().", '".$ing->getNom()."', '".$ing->getImage()."')";
        $statement = $pdo->prepare($sqlRequette);

        try {
            $statement->execute() or die(var_dump($statement->errorInfo()));
        } catch (\Exception $ex) {
            // Arrêt de l'exécution du script PHP
            die("Erreur ajout Ing : " . $ex->getMessage()) ;
            return false;
        }
        echo "Ingredient ajouté !";
        return true;
    }

    public static function ajouterRecette(Recette $rec, $pdo):bool{
        $array = DataBase::chargerRecettes($pdo);

        foreach($array as $e){ // si l'id sont les meme OU tout les attributs sont les memes sauf id et titres
            if(($e["id"] == $rec->getId()) || ( $e["listeIdIng"] == $rec->getListeIdIng() && $e["description"] == $rec->getDescribe() && $e["photo"] == $rec->getPhoto() && $e["listeTag"] == $rec->getListeTag())){
                return true;
            }
        }
        // ATTRIBUTS DE RECETTE
        $id = $rec->getId(); $titre = $rec->getTitre(); $listIng = json_encode($rec->getListeIdIng()); $describe = $rec->getDescribe(); $photo = $rec->getPhoto(); $listTag = json_encode($rec->getListTag());

        $sqlRequette = "INSERT INTO Recette (id, titre, listeIdIng, description, photo, listeTag) VALUES ('".$id."', '".$titre."', '".$listIng."', '".$describe."', '".$photo."', '".$listTag."')";
        $statement = $pdo->prepare($sqlRequette);
        try {
            if(empty($verif)){
                $statement->execute() or die(var_dump($statement->errorInfo()));
            }
        } catch (\Exception $ex) {
            // Arrêt de l'exécution du script PHP
            die("Erreur : " . $ex->getMessage()) ;
            return false;
        }
        echo "Recette ajoutée !";
        return true;
    }

    public static function SupprimerIng($idIng ,$pdo): bool{
        
        $array = DataBase::chargerIngredients($pdo);

        foreach($array as $e){
            if($e["idIng"] == $idIng){
                $sqlRequette = "DELETE FROM Ingredient WHERE idIng = ". $idIng;
                $statement = $pdo->prepare($sqlRequette);

                try{
                    $statement->execute() or die(var_dump($statement->errorInfo()));
                }catch(\Exception $ex){
                    die("Erreur supprimer ingrédient : ". $ex->getMessage());
                    return false;
                }
            }
        }
        return true;

    }

    public static function SupprimerTag(Tag $tag, $pdo): bool{
        $array = DataBase::chargerTags($pdo);

        foreach($array as $e){
            if($e["nomTag"] == $tag->getNom()){
                $sqlRequette = "DELETE FROM tag WHERE nomTag = ". $tag->getNom();
                $statement = $pdo-> prepare($sqlRequette);

                try{
                    $statement->execute() or die(var_dump($statement->errorInfo()));
                    return true;
                }
                catch(\Exception $ex){
                    die("Erreur supprimer tag : " . $ex->getMessage());
                    return false;
                }
            }
        }

        return true;

    }

    //public static function SupprimerRecette()


    public static function ModifierTag(Tag $tag, $id, $pdo){
        
    }
    //public static function ModifierIng()


    //public static function ModifierRecette();


    
} 
?>