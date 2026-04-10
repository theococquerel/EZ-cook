<?php

require_once "DataBase.php";

header('Content-Type: application/json');

$pdo = DataBase::getConnection();

$id = $_GET['id'] ?? null;

if($id === null){
    echo json_encode(["error" => "ID manquant"]);
    exit;
}

$sql = "SELECT * FROM Recette WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

$recette = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$recette){
    echo json_encode(["error" => "Recette introuvable"]);
    exit;
}

$ids = json_decode($recette['listeIng'] ?? '[]', true);

$ingredients = [];

if (!empty($ids) && is_array($ids)) {

    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $sql = "SELECT nomIng FROM Ingredient WHERE nomIng IN ($placeholders)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array_values($ids));

    $ingredients = $stmt->fetchAll(PDO::FETCH_COLUMN);
}

$recette['ingredients'] = $ingredients;

echo json_encode($recette);