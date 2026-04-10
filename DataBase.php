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
        $db_port = "3307" ; //lucien = "3306" et yann et theo = "3307"

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

    // Methode pour charger tout les element d'une table quelconque
    
    public static function chargerTable($pdo, $table){
        $sqlAllElt = "SELECT * FROM ". $table;
        $statement = $pdo->prepare($sqlAllElt);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function ajoutertag(Tag $tag, $pdo):bool{

        $array = DataBase::chargerTable($pdo,"tag");

        foreach($array as $e){
            if($e["nomTag"] == $tag->getNom()){
                return true;
            }
        }

        $sqlRequette = "INSERT INTO tag (nomTag) VALUES ('". $tag->getNom() ."')";

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

        $array = DataBase::chargerTable($pdo, "Ingredient");

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


    public static function ajouterRecette(Recette $rec, $pdo): bool {

    $array = DataBase::chargerTable($pdo, "recette");

    foreach($array as $e){
        if(($e["id"] == $rec->getId()) ||
           ($e["listeIng"] == json_encode($rec->getListeIdIng())
            && $e["description"] == $rec->getDescribe()
            && $e["photo"] == $rec->getPhoto()
            && $e["listeTag"] == json_encode($rec->getListTag()))){
            return false;
        }
    }

    $sql = "SELECT MAX(id) as max_id FROM recette";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // calcul du nouvel id
    $id = ($result['max_id'] ?? 0) + 1;



    $titre = $rec->getTitre();
    $listIng = json_encode($rec->getListeIdIng());
    $describe = $rec->getDescribe();
    $photo = $rec->getPhoto();
    $listTag = json_encode($rec->getListTag());

    //  requête préparée
    $sql = "INSERT INTO Recette (id, titre, listeIng, description, photo, listeTag)
            VALUES (:id, :titre, :listeIng, :description, :photo, :listeTag)";

    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':id' => $id,
            ':titre' => $titre,
            ':listeIng' => $listIng,
            ':description' => $describe,
            ':photo' => $photo,
            ':listeTag' => $listTag
        ]);
    } catch (\Exception $ex) {
        die("Erreur : " . $ex->getMessage());
        return false;
    }

    return true;
}

    public static function SupprimerIng($idIng ,$pdo): bool{
        
        $array = DataBase::chargerTable($pdo, "ingredient");

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

    public static function SupprimerTag($nomTag, $pdo): bool{
        $array = DataBase::chargerTable($pdo, "tag");

        foreach($array as $e){
            if($e["nomTag"] == $nomTag){
                $sqlRequette = "DELETE FROM tag WHERE nomTag = '". $nomTag . "'";
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

    public static function SupprimerRecette($id, $pdo){
        $array = DataBase::chargerTable($pdo, "recette");

        foreach($array as $e){
            if($e["id"] == $id){
                $sqlRequette = "DELETE FROM recette WHERE id = " . $id;
                $statement = $pdo->prepare($sqlRequette);

                try{
                    $statement->execute() or die(var_dump($statement->errorInfo()));
                    return true;
                }
                catch(\Exception $ex){
                    die("Erreur supprimer recette : " . $ex->getMessage());
                    return false;
                }
            }
        }
        return true;
    }

    // Modification de l'objet ingredient par ing a l'id = $idIng
    public static function ModifierIng(Ingredient $ing,$idIng,$pdo): bool{
        $array = DataBase::chargerTable($pdo, "ingredient");

        foreach($array as $e){
            if($e["idIng"] == $idIng){
                $sqlRequette = "UPDATE ingredient SET nomIng ='" . $ing->getNom() . "', SET imageIng ='" . $ing->getImage() . "' WHERE idIng =". $idIng;
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

    // PAS DE MODIFIER TAG CAR IL NY A QU UNE CLE PRIMAIRE DEDANS

    public static function ModifierRecette(Recette $rec, $id, $pdo): bool{
        $array = DataBase::chargerTable($pdo, "recette");

        foreach($array as $e){
            if($e["id"] == $id){
                $id = $rec->getId(); $titre = $rec->getTitre(); $listIng = json_encode($rec->getlisteIdIng()); $describe = $rec->getDescribe(); $photo = $rec->getPhoto(); $listTag = json_encode($rec->getListTag());
                $sqlRequette = "UPDATE recette SET titre =" . $titre . ", SET listeIng=". $listIng . ", SET description =" . $describe . ", SET photo =" . $photo . ", SET listeTag =". $listTag . " WHERE id=" . $id;
                $statement = $pdo->prepare($sqlRequette);

                try{
                    $statement->execute() or die(var_dump($statement->errorInfo()));
                }
                catch(\Exception $ex){
                    die("Erreur supprimer recette : " . $ex->getMessage());
                    return false;
                }
            }
        }
        return true;
    }

    // RECHERCHE SUR LA TABLE DE RECETTE INDEX.PHP

    public static function recherche($search, $tags, $pdo): array {

        // forcer encodage
        $pdo->exec("SET NAMES utf8mb4");

        $sql = "SELECT * FROM recette WHERE 1";
        $params = [];
        
        // recherche texte (insensible casse + accents)
        if (!empty($search)) {
            $sql .= " AND (
                LOWER(titre) LIKE :search
                OR LOWER(description) LIKE :search
                OR LOWER(listeIng) LIKE :search
            )";
            $params[':search'] = "%" . strtolower($search) . "%";
        }

        // filtre tags
        if (!empty($tags)) {
            foreach ($tags as $i => $tag) {
                $sql .= " AND listeTag LIKE :tag$i";
                $params[":tag$i"] = "%" . $tag . "%";
            }
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}